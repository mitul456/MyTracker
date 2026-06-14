<?php

namespace App\Repositories\Contracts;

interface OTPMailRepositoryInterface
{
    public function sendOTP();
    public function verifyOTP($email, $otp);
}