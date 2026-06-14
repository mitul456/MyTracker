<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function registerPage()
    {
        return Inertia::render('Auth/Register');
    }

    public function loginPage()
    {
        return Inertia::render('Auth/Login');
    }

    public function register(Register $request)
    {
        $data = $request->validated();
        $this->authService->register($data);
        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }

    public function login(Login $request)
    {
        
        if(!$this->authService->login($request->validated())) {
             
            throw ValidationException::withMessages([
               'login'=>'Invalid Email or Password.' 
            ]);
            
        }
        
        $request->session()->regenerate();
        return redirect('/dashboard')->with('success', 'Login successful.');
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}


