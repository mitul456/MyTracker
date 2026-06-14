<?php

namespace App\Http\Controllers;

use App\Services\OTPMailService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MailController extends Controller
{
    protected $mailRepo;

    public function __construct(OTPMailService $mailRepo) {
        $this->mailRepo = $mailRepo;
    }
    public function sendOTP() {

        $this->mailRepo->sendOTP();
        return redirect('/verify-otp')->with('success', 'OTP sent successfully');            
    }


    public function verifyOTPPage() {
        return Inertia::render('Settings/OTPVerify');
    }

    public function verifyOTP(Request $request) {

        $user = auth()->user();
        $otp = $user->otp = null;
        $status = $user->status = true;

        if ($request->input('otp') === $otp) {
            $user->update([
                'status' => $status,
                'otp' => $otp
            ]);
                   
            return redirect('/dashboard')->with('success', 'OTP verified successfully');
        }

        return redirect('/verify-otp')->with('error', 'Invalid OTP');

    }



}
