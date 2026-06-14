<?php

namespace App\Repositories;

use App\Mail\OTPMail;
use App\Repositories\Contracts\OTPMailRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OTPMailRepository implements OTPMailRepositoryInterface
{
    public function sendOTP()
    {

        DB::transaction(function () {
            
            $user = auth()->user();

            $name = auth()->user()->name;
            $to = auth()->user()->email;
            $subject = "OTP Verification";
            $otp = rand(100000, 999999);
            Mail::to($to)->send(new OTPMail($otp, $subject, $name));

            $user->otp = $otp;
            $user->save();
            
            return true;
        });
    }

    public function verifyOTP($email, $otp)
    {
        return true;
    }
}