<?php

namespace App\Http\Controllers;

use App\Services\UserProfileService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    protected $userProfileService;

    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }

    public function index()
    {
        $profile = $this->userProfileService->getAll();
        $user = auth()->user();

        return Inertia('UserProfile/Index', [
            'profile' => $profile,
            'user' => $user,
        ]);
    }
}
