<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicInformation;
use App\Models\Consultation;
use App\Models\Exposure;
use App\Models\Location;
use App\Models\ScheduleOfVaccination;
use App\Models\SiteOfBite;
use App\Models\Treatment;
use Illuminate\Http\Request;
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
            'lat' => 'required',
            'long' => 'required',
            'name' => 'required',
            'open' => 'required',
            'closed' => 'required',
            'days' => 'required|array',
        ]);
        

        // Check if a new profile picture has been uploaded
        if ($request->hasFile('profile')) {
            // Store the uploaded file and update the user's profile picture
            $path = $request->file('profile')->store('clinics', 'public');

            // If the user already has a profile picture, delete the old one
            // if ($user->profile) {
            //     // If you want to delete the old profile picture, you can uncomment the line below
            //     Storage::disk('public')->delete($user->profile);
            // }
            $location = Location::create(['user_id'=>auth()->user()->id, 'lat'=>$validateInfo['lat'], 'long'=>$validateInfo['long'], 'isDefined'=>true]);
            
            ClinicInformation::create([
                'location_id'=>$location->id,
                'profile'=>$path,
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

            $patientRecords = Treatment::with(['bite','exposure','schedule'])->where('clinic_id',auth()->user()->id)->get();
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
        // dd($request);
        //for now lets required the body_parts
        $validated = $request->validate(['body_parts'=>'required']);
        // for now by passed the validation
       $treatment =  Treatment::create([
            'user_id' => $request->patient_id,
            'clinic_id' => auth()->user()->id,
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
                    $scheduleOfVac = ScheduleOfVaccination::create([
                        'treatment_id'=>$treatment->id,
                        'booster_dose'=>$request->booster_dose ?? null,
                        // post
                        'post_day_0'=>$request->post_date_of_day_zero,
                        'post_time_0'=>$request->post_time_of_day_zero,
                        'post_site_0'=>$request->post_site_of_day_zero,
                        'post_rl_0'=>$request->post_r_or_l_zero,
                        'post_nod_0'=>$request->post_nod_zero,
                        'post_day_3'=>$request->post_date_of_day_three,
                        'post_time_3'=>$request->post_time_of_day_three,
                        'post_site_3'=>$request->post_site_of_day_three,
                        'post_rl_3'=>$request->post_r_or_l_three,
                        'post_nod_3'=>$request->post_nod_three,
                        'post_day_7'=>$request->post_date_of_day_seven,
                        'post_time_7'=>$request->post_time_of_day_seven,
                        'post_site_7'=>$request->post_site_of_day_seven,
                        'post_rl_7'=>$request->post_r_or_l_seven,
                        'post_nod_7'=>$request->post_nod_seven,
                        'post_day_14'=>$request->post_date_of_day_fourteen,
                        'post_time_14'=>$request->post_time_of_day_fourteen,
                        'post_site_14'=>$request->post_site_of_day_fourteen,
                        'post_rl_14'=>$request->post_r_or_l_fourteen,
                        'post_nod_14'=>$request->post_nod_fourteen,
                        'post_day_28'=>$request->post_date_of_day_twenty_eight,
                        'post_time_28'=>$request->post_time_of_day_twenty_eight,
                        'post_site_28'=>$request->post_site_of_day_twenty_eight,
                        'post_rl_28'=>$request->post_r_or_l_twenty_eight,
                        'post_nod_28'=>$request->post_nod_twenty_eight,

                        // pre
                        'pre_day_0'=>$request->post_date_of_day_zero,
                        'pre_time_0'=>$request->post_time_of_day_zero,
                        'pre_site_0'=>$request->post_site_of_day_zero,
                        'pre_rl_0'=>$request->post_r_or_l_zero,
                        'pre_nod_0'=>$request->post_nod_zero,
                        'pre_day_7'=>$request->post_date_of_day_seven,
                        'pre_time_7'=>$request->post_time_of_day_seven,
                        'pre_site_7'=>$request->post_site_of_day_seven,
                        'pre_rl_7'=>$request->post_r_or_l_seven,
                        'pre_nod_7'=>$request->post_nod_seven,
                        'pre_day_21'=>$request->post_date_of_day_twenty_one,
                        'pre_time_21'=>$request->post_time_of_day_twenty_one,
                        'pre_site_21'=>$request->post_site_of_day_twenty_one,
                        'pre_rl_21'=>$request->post_r_or_l_twenty_one,
                        'pre_nod_21'=>$request->post_nod_twenty_one,
                    ]);

                    if($scheduleOfVac){
                        $updateStatus = Consultation::find($request->consultation_id)->update(["status"=>true]);
                    }
                }
            }
        }
        return Redirect::route('admin.appointment')->with(['status'=>'success']);
    }
}
