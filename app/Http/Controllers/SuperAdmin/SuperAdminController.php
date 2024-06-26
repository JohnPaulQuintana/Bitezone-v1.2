<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SuperAdminController extends Controller
{
    public function index(){
        $needToVerified = User::with('location.clinic')->where('isAdmin',1)->whereHas('location')->orderBy('verified', 'asc')->get();
        // dd($needToVerified);
        return view('admin.account', compact('needToVerified'));
    }

    public function verified(Request $request){
        // dd($request);
        $user = User::find($request->user_id);
        // dd($user);
        if($user){
            $user->update(['verified'=>1]);
            $this->setupNotif($user->id, 'Your clinic verification is now verified, have a nice day!.', 'verified');
            return Redirect::route('superadmin.account')->with(['verified.status'=>'success']);
        }
    }

    public function declined(Request $request){
        // dd($request);
        // $user = User::find($request->user_id);
        $location = Location::where('user_id',$request->user_id)->first();
        // $clinic = Location::where('user_id',$request->user_id)->first();
        // dd($location);
        if($location){
            $location->delete();
            $this->setupNotif($request->user_id, 'Your clinic verification is rejected, re-process your clinic information!.', 'rejected');
            return Redirect::route('superadmin.account')->with(['verified.status'=>'rejected']);
        }
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
}
