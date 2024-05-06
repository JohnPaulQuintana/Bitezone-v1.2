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
        $records = Consultation::where('user_id', Auth::user()->id)->orderByDesc('created_at')->paginate(10);
        return view('user.record', compact("location", "records"));
    }
    // clinic
    public function clinic(){
        $location = Location::where('user_id',auth()->user()->id)->first();
        return view('user.clinic', compact("location"));
    }
    
    // store location of the user
    public function setLocation(Request $request){
        // dd($request);

        $validated = $request->validate([
            'lat' => "required",
            'long' => "required",
        ]);

        if($validated){
           $location = Location::create(['user_id'=>Auth::user()->id, 'lat'=>$validated['lat'], 'long'=>$validated['long']]);
           // Optionally, return a response indicating success
            return response()->json(['status' => 'success','message' => 'Location enabled successfully', 'location' => $location], 201);
        }
    }

    // store consultation
    public function send(Request $request){
        $validated = $request->validate([
            'message' => 'required',
        ]);

        if($validated){
            Consultation::create(['user_id'=>Auth::user()->id, 'consultation'=>$validated['message']]);
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
