<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {
        DB::transaction(function () use ($data) {
            $user = User::create($data);

            UserProfile::create([
                'user_id' => $user->id,
                'currency' => '$',
            ]);
            
            return $user;
        });
    }

    public function login(array $data)
    {
        $credentials = Auth::attempt($data);
        return $credentials;
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return true;
    }   
}