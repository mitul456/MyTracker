<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class SecurityController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Settings/Security', [
            'emailVerified' => !is_null($request->user()->email_verified_at),
            'user' => $request->user(),
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'confirmed',
                Password::defaults(),
            ],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function resendVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return back();
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification email sent.');
    }

    public function logoutOtherDevices(Request $request)
    {
        $request->validate([
            'password' => ['required'],
        ]);

        Auth::logoutOtherDevices($request->password);

        return back()->with('success', 'Other devices logged out.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


}
