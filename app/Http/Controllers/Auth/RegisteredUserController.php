<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\MinimumAge;
use App\Rules\StrongPassword;
use App\Rules\ValidContactNumber;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => ['required', 'string','regex:/^[a-zA-Z\s]+$/u', 'min:6','max:100'],// Accepts only letters and spaces
            'lastname' => ['required', 'string','regex:/^[a-zA-Z\s]+$/u', 'min:6','max:100'],
            'gender' => ['required', 'string', 'max:255'],
            'dateofbirth' => ['required', new MinimumAge],
            'contact_no' => ['required', 'string', new ValidContactNumber],
            'address' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), new StrongPassword],
        ]);

        $role = 0;
        switch ($request->p) {
            case 'physician':
                $role = 1;
                break;
            
            default:
                $role = 0;
                break;
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'dateofbirth' => $request->dateofbirth,
            'contact_no' => $request->contact_no,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'isAdmin' => $role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        if(auth()->user()->isAdmin){
            return redirect()->intended(RouteServiceProvider::Admin);
        }else{
            return redirect()->intended(RouteServiceProvider::User);
        }
    }
}
