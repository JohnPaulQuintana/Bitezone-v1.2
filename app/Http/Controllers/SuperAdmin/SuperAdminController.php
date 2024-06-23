<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index(){
        $needToVerified = User::where('isAdmin',1)->where('verified',0)->get();
        // dd($needToVerified);
        return view('admin.account', compact('needToVerified'));
    }
}
