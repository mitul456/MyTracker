<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function index()
    {
        

    

        $user = auth()->user();

        $profile = $user->profile;

        if (!$profile) {
            $profile = UserProfile::create([
                'user_id' => $user->id,
                'currency' => '$',
            ]);
        }

        return Inertia::render('Settings/Profile', [
            'user' => $user,
            'profile' => $profile,
        ]);

    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,jfif|max:2048',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
        ]);

        $profile = $user->profile;

        $avatar = $profile?->avatar;

        if ($request->hasFile('avatar')) {

            if ($avatar) {
                Storage::disk('public')->delete($avatar);
            }

            $avatar = $request
                ->file('avatar')
                ->store('avatars', 'public');
        }

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => $validated['address'] ?? null,
                'currency' => $validated['currency'] ?? 'BDT',
                'avatar' => $avatar,
            ]
        );

        return back();
    }
}
