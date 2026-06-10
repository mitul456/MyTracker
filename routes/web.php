<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/login');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'registerPage']);
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');

    Route::post('/register/store', [AuthController::class, 'register']);
    Route::post('/login/store', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/accounts', AccountController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/transactions', TransactionController::class);
});