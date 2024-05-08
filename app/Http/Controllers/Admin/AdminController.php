<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicInformation;
use App\Models\Consultation;
use App\Models\Location;
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
        return view('admin.patient', compact('location'));
    }

    //examination
    public function examination(Request $request){
        $location = Location::where('user_id',auth()->user()->id)->first();
        $examination = Consultation::with('user')->where('id', $request->id)->first();
        return view('admin.examination', compact('location', 'examination'));
    }
}
