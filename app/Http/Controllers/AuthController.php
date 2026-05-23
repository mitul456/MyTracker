<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\Register;
use App\Services\AuthService;
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
        return redirect('/login')->with('message', 'Registration successful. Please login.');
    }

    public function login(Login $request)
    {
        $data = $request->validated();
        $authenticated = $this->authService->login($data);

        if (!$authenticated) {
            return redirect('/login')->with('message', 'Invalid credentials. Please try again.');
        }
        return redirect('/dashboard')->with('message', 'Login successful');
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect('/login')->with('message', 'You have been logged out.');
    }
}
