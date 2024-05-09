<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index(){
        $location = Location::where('user_id',auth()->user()->id)->first();
        
        // dd($location);
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
            Consultation::create(['user_id'=>Auth::user()->id, 'clinic_id' => $request->user_id ,'consultation'=>$validated['message']]);
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
}
