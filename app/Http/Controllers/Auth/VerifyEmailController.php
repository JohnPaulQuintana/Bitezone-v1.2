<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // if ($request->user()->hasVerifiedEmail()) {
        //     return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        // }

        // if ($request->user()->markEmailAsVerified()) {
        //     event(new Verified($request->user()));
        // }

        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');

        // Fetch the authenticated user and determine the appropriate redirect URL
        $user = $request->user();
        $redirectUrl = $user->isAdmin ? RouteServiceProvider::Admin : RouteServiceProvider::User;

        // Check if the user has already verified their email
        if ($user->hasVerifiedEmail()) {
            // If already verified, redirect to the appropriate URL with the `?verified=1` query parameter
            return redirect()->intended($redirectUrl . '?verified=1');
        }

        // If the user's email is not already verified, attempt to mark it as verified and trigger the `Verified` event
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Redirect the user to the appropriate URL with the `?verified=1` query parameter
        return redirect()->intended($redirectUrl . '?verified=1');
    }
}
