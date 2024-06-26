<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Booster;
use App\Models\ClinicInformation;
use App\Models\Consultation;
use App\Models\Exposure;
use App\Models\FollowUpVaccine;
use App\Models\Location;
use App\Models\Notification;
use App\Models\PostExposure;
use App\Models\PreExposure;
use App\Models\ScheduleOfVaccination;
use App\Models\SiteOfBite;
use App\Models\Treatment;
use App\Models\User;
use App\Notifications\NotifyClinic;
use App\Notifications\NotifyUser;
use App\Notifications\Walkin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public function index(){
        $location = Location::with(['clinic'])->where('user_id',auth()->user()->id)->first();
        
        return view('admin.index', compact('location'));
    }

    // setup clinic
    public function setup(Request $request){
        // dd($request);

        $validateInfo = $request->validate([
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'name' => 'required',
            'open' => 'required',
            'closed' => 'required',
            'days' => 'required|array',
        ]);
        

        // Check if a new profile picture has been uploaded
        if ($request->hasFile('profile') && $request->hasFile('certificate')) {
            // Store the uploaded file and update the user's profile picture
            $path = $request->file('profile')->store('clinics', 'public');
            $cert = $request->file('certificate')->store('clinics', 'public');

            // If the user already has a profile picture, delete the old one
            // if ($user->profile) {
            //     // If you want to delete the old profile picture, you can uncomment the line below
            //     Storage::disk('public')->delete($user->profile);
            // }
            $location = Location::create(['user_id'=>auth()->user()->id, 'address'=>$validateInfo['address'],'lat'=>$validateInfo['lat'], 'long'=>$validateInfo['long'], 'isDefined'=>true]);
            
            ClinicInformation::create([
                'location_id'=>$location->id,
                'profile'=>$path,
                'certificate'=>$cert,
                'name'=>$validateInfo['name'],
                'open'=>$validateInfo['open'],
                'closed'=>$validateInfo['closed'],
                'days_of_week'=>json_encode($validateInfo['days'])
            ]);
            
            return Redirect::route('admin.index')->with('status', 'setup-success'); 
        }

        
    }

    // appointment
    public function appointment(){
        $location = Location::where('user_id',auth()->user()->id)->first();
        $appointments = Consultation::with('user')
            ->where('clinic_id',auth()->user()->id)
            ->where('status', 0)//means waiting
            ->paginate(10);
            // dd($appointments);
        return view('admin.appointment', compact('location', 'appointments'));
    }
    // patient
    public function patient(){
        $location = Location::where('user_id',auth()->user()->id)->first();
        // $appointments = Consultation::with('user')
        //     ->where('clinic_id',auth()->user()->id)
        //     ->paginate(10);
            // dd($appointments);

            $patientRecords = Treatment::with(['user','bite','exposure','post_exposure','pre_exposure','booster'])->where('clinic_id',auth()->user()->id)->get();
            // dd($patientRecords);
        return view('admin.patient', compact('location', 'patientRecords'));
    }

    //examination
    public function examination(Request $request){
     
        $location = Location::where('user_id',auth()->user()->id)->first();
        $examination = Consultation::with('user')->where('id', $request->id)->first();
        return view('admin.examination', compact('location', 'examination'));
    }

    // treatment
    public function treatment(Request $request){
        
        //for now lets required the body_parts
        $validated = $request->validate([
            'body_parts'=>'required', 
            'type' => 'required',
            'sday' => 'required',
            'sdate' => 'required',
            'stime' => 'required',
            'rl' => 'required',
            'site' => 'required',
            'date_of_incidence' => 'required',
            'place_of_incidence' => 'required',
            'type_of_bite' => 'required',
            'site_of_bite' => 'required',
            'animal' => 'required',
        ]);
        
        // for now by passed the validation
       $treatment =  Treatment::create([
            'user_id' => $request->patient_id,
            'clinic_id' => auth()->user()->id,
            'consultation_id' => $request->consultation_id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'age' => $request->age,
            'gender' => $request->gender,
            'date' => $request->date,
            'time' => $request->time,
            'record_number' => $request->record_number ?? "xxx-xxx-2024",
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'contact_number' => $request->contact_no,
            'chief_complain' => $request->complain,
            'bp' => $request->bp,
            'pr' => $request->pr,
            'rr' => $request->rr,
            'temp' => $request->temperature,
            'wt' => $request->wt,
            'history_of_illness' => $request->history_of_present_illness,
            'pertinent_pe' => $request->pertinent_pe,
            'diagnosis' => $request->diagnosis,
            'home_medicine' => $request->home_medicine,
        ]);

        if($treatment){
            $siteofbite = SiteOfBite::create(['treatment_id'=>$treatment->id,'site_of_bite'=>json_encode($request->body_parts)]);

            if($siteofbite){
                $exposure = Exposure::create([
                    'treatment_id'=>$treatment->id,
                    'date_of_incidence'=>$request->date_of_incidence,
                    'place_of_incidence'=>$request->place_of_incidence,
                    'animal_type'=>$request->animal,
                    'animal_status'=>$request->status_of_animal,
                    'type_of_bite'=>$request->type_of_bite,
                    'washing_of_bite'=>$request->washing_of_bite,
                    'site_of_bite'=>$request->site_of_bite,
                    'previous_vaccination'=>$request->previous_vaccination_year,
                    'status'=>$request->previous_vaccination_status,
                    'tissue_culture_vaccine'=>$request->tissue_culture_vaccine,
                    'rabies_immunoglobulin'=>$request->rabies_immunoglobulin,
                    'erig'=>$request->erig,
                    'dose'=>$request->dose,
                    'anti_titanus'=>$request->anti_tetanus,
                ]);

                if($exposure){
                    switch ($request->type) {
                        case 'BOOSTER DOSE':
                           $scheduleOfVac = Booster::create([
                                "treatment_id" =>$treatment->id,
                                "booster_dose" =>$request->type,
                            ]);
                            break;
                        case 'POST EXPOSURE':
                           $scheduleOfVac = PostExposure::create([
                                "treatment_id" =>$treatment->id,
                                "day" =>$request->sday,
                                "date" =>$request->sdate,
                                "time" =>$request->stime,
                                "site" =>$request->site,
                                "rl" =>$request->rl,
                                "nod" =>$request->nod,
                            ]);
                            break;
                        case 'PRE EXPOSURE':
                           $scheduleOfVac = PreExposure::create([
                                "treatment_id" =>$treatment->id,
                                "day" =>$request->sday,
                                "date" =>$request->sdate,
                                "time" =>$request->stime,
                                "site" =>$request->site,
                                "rl" =>$request->rl,
                                "nod" =>$request->nod,
                            ]);
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                    

                    if($scheduleOfVac){
                        $updateStatus = Consultation::find($request->consultation_id)->update(["status"=>true]);
                        $this->setupNotif($request->patient_id, 'Has added a new vaccine on your records!', "Appointment");
                        //email
                        $details = [
                            'subject' => "Notification: ".auth()->user()->firstname." is recorded your appoinment!.",
                            'actionurl' => route('user.index'),
                            'line-1' => 'Your Appointment has been recorded to our system',
                            'line-2' => 'Sender:'.auth()->user()->firstname.' '.auth()->user()->lastname,
                            'line-3' => 'Contact Number:'.auth()->user()->contact_no,
                            'line-4' => 'Date and Time:'.now(),
                        ];
                        $this->sendEmailNotificationToUser($request->patient_id, $details);
                    }
                }
            }
        }
        return Redirect::route('admin.appointment')->with(['status'=>'success']);
    }

    //walkin
    public function walkin(){
        return view('admin.walkin.walkin');
    }

    //treatment walkin
    public function treatmentWalkin(Request $request){
        // dd($request);
         //for now lets required the body_parts
         $validated = $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'dateofbirth'=>'required',
            'contact_no'=>'required',
            'address'=>'required',
            'email'=>'required|email',
            'body_parts'=>'required', 
            'type' => 'required',
            'sday' => 'required',
            'sdate' => 'required',
            'stime' => 'required',
            'rl' => 'required',
            'site' => 'required',
            'date_of_incidence' => 'required',
            'place_of_incidence' => 'required',
            'type_of_bite' => 'required',
            'site_of_bite' => 'required',
            'animal' => 'required',
        ]);

       

        $user = User::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'middlename'=>$request->middlename,
            'gender'=>$request->gender,
            'dateofbirth'=>$request->dateofbirth,
            'contact_no'=>$request->contact_no,
            'address'=>$request->address,
            // 'email'=>$request->email,
            'email'=>'jpquintana2024@gmail.com',
            'password'=>Hash::make('*Walkin2024'),//default password for walkin
            'isAdmin'=>0,
            
        ]);

        if($user){
            $consultation = Consultation::create([
                'user_id'=> $user->id,
                'clinic_id' => auth()->user()->id,
                'consultation'=>"Walked in consultation for vaccine.",
                'status'=>0,
            ]);
             // Calculate age from date of birth
            $dateOfBirth = Carbon::parse($request->dateofbirth);
            $age = $dateOfBirth->age;

            // for now by passed the validation
            $treatment =  Treatment::create([
                'user_id' => $user->id,
                'clinic_id' => auth()->user()->id,
                'consultation_id' => $consultation->id,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'middlename' => $request->middlename,
                'age' => $age,
                'gender' => $request->gender,
                'date' => $request->dateofbirth,
                'time' => $request->time,
                'record_number' => $request->record_number ?? "xxx-xxx-2024",
                'address' => $request->address,
                'place_of_birth' => $request->place_of_birth,
                'contact_number' => $request->contact_no,
                'chief_complain' => $request->complain,
                'bp' => $request->bp,
                'pr' => $request->pr,
                'rr' => $request->rr,
                'temp' => $request->temperature,
                'wt' => $request->wt,
                'history_of_illness' => $request->history_of_present_illness,
                'pertinent_pe' => $request->pertinent_pe,
                'diagnosis' => $request->diagnosis,
                'home_medicine' => $request->home_medicine,
            ]);

            if($treatment){
                $siteofbite = SiteOfBite::create(['treatment_id'=>$treatment->id,'site_of_bite'=>json_encode($request->body_parts)]);
    
                if($siteofbite){
                    $exposure = Exposure::create([
                        'treatment_id'=>$treatment->id,
                        'date_of_incidence'=>$request->date_of_incidence,
                        'place_of_incidence'=>$request->place_of_incidence,
                        'animal_type'=>$request->animal,
                        'animal_status'=>$request->status_of_animal,
                        'type_of_bite'=>$request->type_of_bite,
                        'washing_of_bite'=>$request->washing_of_bite,
                        'site_of_bite'=>$request->site_of_bite,
                        'previous_vaccination'=>$request->previous_vaccination_year,
                        'status'=>$request->previous_vaccination_status,
                        'tissue_culture_vaccine'=>$request->tissue_culture_vaccine,
                        'rabies_immunoglobulin'=>$request->rabies_immunoglobulin,
                        'erig'=>$request->erig,
                        'dose'=>$request->dose,
                        'anti_titanus'=>$request->anti_tetanus,
                    ]);
    
                    if($exposure){
                        switch ($request->type) {
                            case 'BOOSTER DOSE':
                               $scheduleOfVac = Booster::create([
                                    "treatment_id" =>$treatment->id,
                                    "booster_dose" =>$request->type,
                                ]);
                                break;
                            case 'POST EXPOSURE':
                               $scheduleOfVac = PostExposure::create([
                                    "treatment_id" =>$treatment->id,
                                    "day" =>$request->sday,
                                    "date" =>$request->sdate,
                                    "time" =>$request->stime,
                                    "site" =>$request->site,
                                    "rl" =>$request->rl,
                                    "nod" =>$request->nod,
                                ]);
                                break;
                            case 'PRE EXPOSURE':
                               $scheduleOfVac = PreExposure::create([
                                    "treatment_id" =>$treatment->id,
                                    "day" =>$request->sday,
                                    "date" =>$request->sdate,
                                    "time" =>$request->stime,
                                    "site" =>$request->site,
                                    "rl" =>$request->rl,
                                    "nod" =>$request->nod,
                                ]);
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                        
    
                        if($scheduleOfVac){
                            $updateStatus = Consultation::find($consultation->id)->update(["status"=>true]);
                            $this->setupNotif($user->id, 'Has added a new vaccine on your records!', "Walk-in");
                            //email
                            $details = [
                                'subject' => "Notification: ".auth()->user()->firstname." is recorded your appoinment!.",
                                'actionurl' => route('user.index'),
                                'line-1' => 'Your Appointment has been recorded to our system',
                                'line-2' => 'Sender:'.auth()->user()->firstname.' '.auth()->user()->lastname,
                                'line-3' => 'Contact Number:'.auth()->user()->contact_no,
                                'line-4' => 'Date and Time:'.now(),
                                'line-5' => 'Bitezone Credentials: Email : '.$user->email.' Password : *Walkin2024',
                                'line-6' => 'NOTE : Please update your email or password account for security.',
                            ];
                            $this->sendEmailNotificationToUserWalkin($user->id, $details);
                        }
                    }
                }
            }
            return Redirect::route('admin.appointment')->with(['status'=>'success']);
        }
    }

    // treatment edit
    public function treatmentEdit(Request $request){
        // dd($request->id);
        $location = Location::where('user_id',auth()->user()->id)->first();
        $treatment = Treatment::with(['user','bite','exposure','post_exposure','pre_exposure','booster'])->where('id', $request->id)->first();
        // dd($treatment);
        return view('admin.update', compact('location', 'treatment'));
    }

    // treatment Update
    public function treatmentUpdate(Request $request){
        // dd($request);
        //for now lets required the body_parts
        $validated = $request->validate([
            'body_parts'=>'required', 
           
            'date_of_incidence' => 'required',
            'place_of_incidence' => 'required',
            'type_of_bite' => 'required',
            'site_of_bite' => 'required',
            'animal' => 'required',
        ]);
        
        $treatmentUpdate = Treatment::find($request->treatment_id);

        // Update basic attributes
        $treatmentUpdate->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'middlename' => $request->middlename,
            'age' => $request->age,
            'gender' => $request->gender,
            'date' => $request->date,
            'time' => $request->time,
            'record_number' => $request->record_number ?? "xxx-xxx-2024",
            'address' => $request->address,
            'place_of_birth' => $request->place_of_birth,
            'contact_number' => $request->contact_no,
            'chief_complain' => $request->complain,
            'bp' => $request->bp,
            'pr' => $request->pr,
            'rr' => $request->rr,
            'temp' => $request->temperature,
            'wt' => $request->wt,
            'history_of_illness' => $request->history_of_present_illness,
            'pertinent_pe' => $request->pertinent_pe,
            'diagnosis' => $request->diagnosis,
            'home_medicine' => $request->home_medicine,
        ]);

        if($treatmentUpdate){
            $siteOfBiteUpdate = SiteOfBite::where('treatment_id',$request->treatment_id)->update(['site_of_bite'=>json_encode($request->body_parts)]);
            if($siteOfBiteUpdate){
                $exposure = Exposure::where('treatment_id',$request->treatment_id)->update([
                    'date_of_incidence'=>$request->date_of_incidence,
                    'place_of_incidence'=>$request->place_of_incidence,
                    'animal_type'=>$request->animal,
                    'animal_status'=>$request->status_of_animal,
                    'type_of_bite'=>$request->type_of_bite,
                    'washing_of_bite'=>$request->washing_of_bite,
                    'site_of_bite'=>$request->site_of_bite,
                    'previous_vaccination'=>$request->previous_vaccination_year,
                    'status'=>$request->previous_vaccination_status,
                    'tissue_culture_vaccine'=>$request->tissue_culture_vaccine,
                    'rabies_immunoglobulin'=>$request->rabies_immunoglobulin,
                    'erig'=>$request->erig,
                    'dose'=>$request->dose,
                    'anti_titanus'=>$request->anti_tetanus,
                ]);
            }
        }
        return Redirect::route('admin.treatment.edit', $request->treatment_id)->with(['title'=>'Updated Record!','status'=>'success', 'message'=>"Successfully updated!"]);
    }

    // vacination
    public function vaccination(Request $request){
        // dd($request->follow_id);
        $patientRecordId =$request->id;  
        $followId =$request->follow_id;  
        $location = Location::where('user_id',auth()->user()->id)->first();
        $record = Treatment::with(['user', 'post_exposure', 'pre_exposure', 'booster'])->find($patientRecordId);
        // dd($record);
        return view('admin.vaccine', compact('location', 'record','followId'));

    }

    // add vaccine
    public function vaccine(Request $request){
        // dd($request);
        $validated = $request->validate([
            "type" => "required",
            "sdate" => "required",
            "stime" => "required",
            "site" => "required",
            "rl" => "required",
            "rl" => "required",
        ]);

        switch ($request->type) {
            case 'BOOSTER DOSE':
               $scheduleOfVac = Booster::create([
                    "treatment_id" =>$request->treatment_id,
                    "booster_dose" =>$request->type,
                ]);

                
                break;
            case 'POST EXPOSURE':
               $scheduleOfVac = PostExposure::create([
                "treatment_id" =>$request->treatment_id,
                    "day" =>$request->sday,
                    "date" =>$request->sdate,
                    "time" =>$request->stime,
                    "site" =>$request->site,
                    "rl" =>$request->rl,
                    "nod" =>$request->nod,
                ]);
                break;
            case 'PRE EXPOSURE':
               $scheduleOfVac = PreExposure::create([
                "treatment_id" =>$request->treatment_id,
                    "day" =>$request->sday,
                    "date" =>$request->sdate,
                    "time" =>$request->stime,
                    "site" =>$request->site,
                    "rl" =>$request->rl,
                    "nod" =>$request->nod,
                ]);
                break;
            
            default:
                # code...
                break;
        }

        if($scheduleOfVac){
            FollowUpVaccine::find($request->follow_id)->update(['status'=>1]);
            $reciever_id = Treatment::where('id',$request->treatment_id)->first();
            $this->setupNotif($reciever_id->user_id, 'Has added a new vaccine on your records!', "Vaccine");
            
        }

        return Redirect::route('admin.followup')->with(['title'=>"Vaccine Recorded!", 'status'=>'success', 'message'=>"New vaccine recorded."]);
    }

    // view record
    public function open(Request $request){
        // dd($request->id);
        $location = Location::where('user_id',auth()->user()->id)->first();
        $treatment = Treatment::with(['user','bite','exposure','post_exposure','pre_exposure','booster'])->where('id', $request->id)->first();
        return view('admin.open', compact('location', 'treatment'));
    }

    // announcement
    public function announcement(){
        $location = Location::where('user_id',auth()->user()->id)->first();
        $announcements = Announcement::with(['user.location.clinic'])->where('user_id',auth()->user()->id)->orderByDesc('created_at')->get();
        return view('admin.announcement', compact('location', 'announcements'));
    }

    // create announcemnt
    public function create(Request $request){
        // dd($request);
        $validated = $request->validate([
            "title" => 'required',
            "type" => 'required',
            "details" => 'required',
            "date" => 'required',
            "time" => 'required',
        ]);

        Announcement::create([
            'user_id' => auth()->user()->id,
            'title'=>$validated['title'],
            'details'=>$validated['details'],
            'date'=>$validated['date'],
            'time'=>$validated['time'],
            'type'=>$validated['type'],
            'url'=>$request->url ?? null,
        ]);
        $this->setupNotifToAll();
        return Redirect::route('admin.announcement')->with(['title'=>'Announcement Posted!','message'=>"You successfully created an announcement!.",'icon'=>'success']);
    }

    // edit announcement
    public function edit(Request $request){
        // dd($request->id);
        $announcement = Announcement::find($request->id);
        // dd($edit);
        return view('admin.announcement.edit', compact('announcement'));
    }
    // update announcement
    public function update(Request $request){
        // dd($request);
        $validated = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'details' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        $announcement = Announcement::find($request->id);
        $announcement->update([
            "title" =>$validated['title'],
            "type" =>$validated['type'],
            "details" =>$validated['details'],
            "date" =>$validated['date'],
            "time" =>$validated['time'],
            "url" =>$request->url ?? null,
        ]);
        // dd($edit);
       return Redirect::route('admin.announcement.edit', $request->id)->with(['title'=>"Annoucement Updated!", 'message'=>"You successfully updated the announcement!.", 'icon'=>'success']);
    }

    // delete addnouncemnet
    public function delete(Request $request){
        // dd($request->id);
        Announcement::destroy($request->id);
        return Redirect::route('admin.announcement')->with(['title'=>"Annoucement Deleted!", 'message'=>"You successfully deleted the announcement!.", 'icon'=>'success']);
    }

    //follow up vaccine
    public function followup(){
        $location = Location::where('user_id',auth()->user()->id)->first();
        $followups = FollowUpVaccine::with('consultation.user.treatment')->where('status',0)->paginate(10);
        // dd($followups);
        return view('admin.followup.appointment', compact('location','followups'));
    }

    // setup notification
    private function setupNotif($id, $details, $type){
        Notification::create([
            'user_id'=>$id, 'profile'=>auth()->user()->profile, 
            'name'=>auth()->user()->firstname.' '.auth()->user()->lastname,
            'details'=>$details,
            'type'=>$type,
        ]);
    }
   
    // setup notification for all announcement
    private function setupNotifToAll(){
        $senderId = auth()->id();
        $users = User::where('id', '!=', $senderId)->get();
        foreach ($users as $key => $value) {
            Notification::create([
                'user_id'=>$value->id, 'profile'=>$value->profile, 
                'name'=>$value->firstname.' '.$value->lastname,
                'details'=>"Has posted an announcement, its available on announcement section page.",
                'type'=>'annoucement',
            ]);
        }
        
    }

     //send email notification
    private function sendEmailNotificationToUser($notifyId, $details){
        $notifyPhysician = User::where('id', $notifyId)->first();
        NotificationFacade::send($notifyPhysician, new NotifyUser($details));
    }
     //send email notification for walkin
    private function sendEmailNotificationToUserWalkin($notifyId, $details){
        $notifyPhysician = User::where('id', $notifyId)->first();
        NotificationFacade::send($notifyPhysician, new Walkin($details));
    }
}
