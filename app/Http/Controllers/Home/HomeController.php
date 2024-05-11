<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Notification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }
    public function guest(){
        $announcements = Announcement::with(['user.location.clinic'])->orderByDesc('created_at')->get();
        // dd($announcements);
        return view('guest',compact('announcements'));
    }

    public function notif(){
        $notifications = Notification::where('user_id',auth()->user()->id)->orderByDesc('created_at')->get(); 
        return response()->json(["notification"=>$notifications]);
    }
}
