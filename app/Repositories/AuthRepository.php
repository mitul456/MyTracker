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

    public function login(array $data): bool
    {
        return Auth::attempt(
            [
                'email' => $data['email'],
                'password' => $data['password']
            ]
        );
        $data['remember'] ?? false;
    }

    public function logout():void
    {
        Auth::logout();        
    }   
}
        