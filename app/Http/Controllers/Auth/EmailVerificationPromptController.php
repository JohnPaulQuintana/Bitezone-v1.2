<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
         // Fetch the authenticated user and determine the appropriate redirect URL
         $user = $request->user();
         $redirectUrl = $user->isAdmin ? RouteServiceProvider::Admin : RouteServiceProvider::User;

        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended($redirectUrl)
                    : view('auth.verify-email');
    }
}
