<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Services\UserProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    // protected $userProfileService;

    // public function __construct(UserProfileService $userProfileService)
    // {
    //     $this->userProfileService = $userProfileService;
    // }

    public function index()
    {
        // $profile = $this->userProfileService->getAll();
        $user = Auth::user();
        $profile = UserProfile::where('user_id', $user->id)->first();

        return Inertia::render('Settings/Profile', [
            'profile' => $profile,
            'user' => $user,
        ]);

    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,',
            'phone' => 'nullable',
            'address' => 'nullable',
            'avatar' => 'nullable',
        ]);
    
        
        DB::transaction(function () use ($request, $id) {
    
            User::where('id', $id)->updateOrCreate([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
    
            
    
            $imageName = null;
    
            if ($request->hasFile('avatar')) {
    
                $imageFile = $request->file('avatar');
    
                $imageName = time().'_'.$imageFile->getClientOriginalName();
    
                $imageFile->move(public_path('profiles'), $imageName);
            }
    
            UserProfile::where('user_id', $id)->updateOrCreate([
                'address' => $request->address,
                'currency' => $request->currency,
                'avatar' => 'profiles/' . $imageName
            ]);
    
        });
    
        return redirect()
            ->route('profiles.index')
            ->with('success', 'Profile updated successfully.');
    
        }
    }

     

    

    


          
    




