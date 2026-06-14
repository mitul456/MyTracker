<?php

namespace App\Services;

use App\Repositories\Contracts\OTPMailRepositoryInterface;

class OTPMailService
{
    protected OTPMailRepositoryInterface $repository;

    public function __construct(OTPMailRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function sendOTP()
    {
        return $this->repository->sendOTP();
    }
}