<?php

namespace App\Services;

use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected AuthRepositoryInterface $repository;

    public function __construct(AuthRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['otp'] = rand(100000, 999999);
        return $this->repository->register($data);
    }

    public function login(array $data): bool
    {
        return $this->repository->login($data);
    }

    public function logout():void
    {
        $this->repository->logout();
    }
}