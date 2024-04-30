<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('user.record', compact("location"));
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
}
