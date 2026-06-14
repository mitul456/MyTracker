<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RecurringTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SecurityController;
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
    Route::resource('/recurring-transactions', RecurringTransactionController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('/reports/export-csv', [ReportController::class, 'exportCsv'])
        ->name('reports.export.csv');
    Route::get('/reports/export-excel', [ReportController::class, 'exportExcel'])
        ->name('reports.export.excel');
    Route::get('/reports/print', [ReportController::class, 'print'])
        ->name('reports.print');

    Route::get('/profile', [UserProfileController::class, 'index'])
        ->name('profiles.profile');
    Route::put('/profiles/update', [UserProfileController::class, 'update'])
        ->name('profile.update');



    Route::get('/settings/security', [SecurityController::class, 'index'])
        ->name('settings.security');

    Route::put('/settings/password', [SecurityController::class, 'updatePassword'])
        ->name('settings.password.update');

    Route::post('/settings/logout-other-devices', [SecurityController::class, 'logoutOtherDevices'])
        ->name('settings.logout-other-devices');

    Route::delete('/settings/account', [SecurityController::class, 'destroy'])
        ->name('settings.account.destroy');


    Route::get('/send-otp', [MailController::class, 'sendOTP']);
    Route::get('/verify-otp', [MailController::class, 'verifyOTPPage']);
    Route::post('/verify-otp', [MailController::class, 'verifyOTP']);

});
