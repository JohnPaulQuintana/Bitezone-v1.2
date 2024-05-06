<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $location = Location::where('user_id',auth()->user()->id)->first();
        return view('profile.edit', [
            'location' => $location,
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request);
        $user = $request->user();

        // Validate the request, including the file upload
        $validatedData = $request->validated();

        // Check if a new profile picture has been uploaded
        if ($request->hasFile('profile')) {
            // Store the uploaded file and update the user's profile picture
            $path = $request->file('profile')->store('profiles', 'public');
            $validatedData['profile'] = $path;

            // If the user already has a profile picture, delete the old one
            if ($user->profile) {
                // If you want to delete the old profile picture, you can uncomment the line below
                Storage::disk('public')->delete($user->profile);
            }

            
        }

        $user->fill($validatedData);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // reset your location
    public function reset(Request $request): RedirectResponse
    {
        Location::where('user_id', Auth::user()->id)->delete();
        return Redirect::route('profile.edit')->with('status', 'location-reset');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
