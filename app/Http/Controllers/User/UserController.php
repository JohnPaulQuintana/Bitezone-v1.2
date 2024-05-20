<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Consultation;
use App\Models\FollowUpVaccine;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Treatment;
use App\Models\User;
use App\Notifications\NotifyClinic;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index(){
        $location = Location::where('user_id',auth()->user()->id)->first();
       
        return view('user.index', compact("location"));
    }

    // records
    public function record(){
        $location = Location::where('user_id',auth()->user()->id)->first();
        // $records = Consultation::where('user_id', Auth::user()->id)->orderByDesc('created_at')->paginate(10);
        $records = Consultation::join('users', 'consultations.clinic_id', '=', 'users.id')
        ->join('locations', 'users.id', '=', 'locations.user_id')
        ->join('clinic_information', 'locations.id', '=', 'clinic_information.location_id')
        ->select(
            'consultations.*', 'users.firstname as fname', 'users.middlename as mname', 'users.lastname as lname','users.email', 'users.profile',
            'locations.id as location_id',
            'clinic_information.name as clinic_name'
        ) // Select the columns you need from both tables
        ->where('consultations.user_id', auth()->id())
        ->with(['followup'])
        ->orderByDesc('consultations.created_at')
        ->paginate(1);
        // dd($records);
        return view('user.record', compact("location", "records"));
    }
    // clinic
    public function clinic(){
        $location = Location::where('user_id',auth()->user()->id)->with(['user'])->first();
        // dd($location);
        $clinicLocation = Location::where('isDefined',true)->with('clinic')->get();
        // dd($clinicLocation);
        return view('user.clinic', compact("location", "clinicLocation"));
    }
    
    // store location of the user
    public function setLocation(Request $request){
        // dd($request);

        $validated = $request->validate([
            'address' => "required",
            'lat' => "required",
            'long' => "required",
        ]);

        if($validated){
           $location = Location::create(['user_id'=>Auth::user()->id, 'address'=>$validated['address'],'lat'=>$validated['lat'], 'long'=>$validated['long']]);
           // Optionally, return a response indicating success
            return response()->json(['status' => 'success','message' => 'Location enabled successfully', 'location' => $location], 201);
        }
    }

    // store consultation
    public function send(Request $request){
        // dd($request);
        $validated = $request->validate([
            'message' => 'required',
        ]);

        if($validated){
           $consultation =  Consultation::create(['user_id'=>Auth::user()->id, 'clinic_id' => $request->user_id ,'consultation'=>$validated['message']]);
            //notif
            $this->setupNotif($request->user_id, 'has sent a new appointment for the vaccination.', 'consultation');
            //email
            $details = [
                'subject' => "Notification: ".auth()->user()->firstname." is sending an appoinment!.",
                'actionurl' => route('admin.appointment'),
                'line-1' => 'New Appointment has been sent to you.',
                'line-2' => 'Sender: '.auth()->user()->firstname.' '.auth()->user()->lastname,
                'line-3' => 'Contact Number: '.auth()->user()->contact_no,
                'line-4' => 'Date and Time: '.$consultation->created_at,
            ];
            $this->sendEmailNotificationToClinic($request->user_id,$details);
            return response()->json(['status' => 'success','message' => 'Consultation successfully sent!'], 201);
        }
       
    }

    public function edit(Request $request){
        // dd($request->id);
        $location = Location::where('user_id',auth()->user()->id)->first();
        $records = Consultation::find($request->id);
        return view('user.edit', compact('location', 'records'));
    }
    
    public function update(Request $request){
        // dd($request);
        $record = Consultation::find($request->id);
        $record->consultation = $request->input('message');
        $record->created_at = $request->input('date');
        $record->save();
        return Redirect::route('user.edit', $request->id)->with(['status'=>'success', 'message'=>'Successfully updated!.']);
    }

    // open
    public function open(Request $request){
        $location = Location::where('user_id',auth()->user()->id)->first();
        $treatment = Treatment::with(['user','bite','exposure','post_exposure','pre_exposure','booster'])->where('consultation_id', $request->id)->first();
        // dd($treatment);
        return view('user.open', compact('location', 'treatment'));
    }

     // announcement
     public function announcement(){
        $location = Location::where('user_id',auth()->user()->id)->first();
        $announcements = Announcement::with(['user.location.clinic'])->orderByDesc('created_at')->get();
        return view('user.announcement', compact('location', 'announcements'));
    }

    // followup
    public function followup(Request $request){
        // dd($request);
        $validated = $request->validate([
            "details" => 'required',
            "date" => 'required',
            "time" => 'required',
        ]);

        $follow = FollowUpVaccine::create(['consultation_id'=>$request->consultation_id, 'details'=>$validated['details'],'date'=>$validated['date'],'time'=>$validated['time']]);
        if($follow){
            $reciever_id = Consultation::where('id',$request->consultation_id)->first();
            
            $this->setupNotif($reciever_id->clinic_id, 'has sent a follow-up appointment for the vaccination.', 'follow-up');
            //email
            $details = [
                'subject' => "Notification: ".auth()->user()->firstname." is sending an follow-up appoinment!.",
                'actionurl' => route('admin.appointment'),
                'line-1' => 'New Appointment has been sent to you.',
                'line-2' => 'Sender: '.auth()->user()->firstname.' '.auth()->user()->lastname,
                'line-3' => 'Contact Number: '.auth()->user()->contact_no,
                'line-4' => 'Date and Time: '.now(),
            ];
            $this->sendEmailNotificationToClinic($reciever_id->clinic_id,$details);

        }
        return Redirect::route('user.record')->with(['title'=>'Follow-up Sent!','message'=>"Follow-up vaccine schedule is sent!.",'icon'=>"success"]);
    }

    // follow up details
    public function details(Request $request){
        // dd($request->id);
        $followups = Consultation::with('followup','user.treatment')->where('id',$request->id)->get();
        // dd($followups);
        return view('user.followup.followup', compact('followups'));
    }

    // setup notification
    private function setupNotif($id, $desc, $type){
        Notification::create([
            'user_id'=>$id, 'profile'=>auth()->user()->profile, 
            'name'=>auth()->user()->firstname.' '.auth()->user()->lastname,
            'details'=>$desc,
            'type'=>$type,
        ]);
    }

    //send email notification
    private function sendEmailNotificationToClinic($notifyId, $details){
        $notifyPhysician = User::where('id', $notifyId)->first();
        NotificationFacade::send($notifyPhysician, new NotifyClinic($details));
    }
}
