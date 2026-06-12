<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecurringTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserProfileController;
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
    Route::resource('/transfers', TransferController::class);
    Route::resource('/budgets', BudgetController::class);
    Route::resource('/recurring-transactions',RecurringTransactionController::class);    
    Route::get('/reports',[ReportController::class,'index'])->name('reports.index');
    
    Route::get('/reports/export-csv', [ReportController::class, 'exportCsv'])
    ->name('reports.export.csv');
    Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])
    ->name('reports.export.excel');
    Route::get('/reports/print', [ReportController::class, 'print'])
    ->name('reports.print');

<<<<<<< HEAD
    Route::get('/profiles', function () {
        return Inertia::render('Settings/Profile');
    })->name('profiles.profile');
    
=======
    Route::get('/profiles', [UserProfileController::class, 'index'])->name('profiles.profile');
>>>>>>> 8b85254030f891d91ef4edc244fe838cd0d7d63c
    Route::get('/security', function () {
        return Inertia::render('Settings/Security');
    })->name('profiles.Security');
});
   