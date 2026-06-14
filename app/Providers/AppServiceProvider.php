<?php

namespace App\Providers;

use App\Repositories\AccountRepository;
use App\Repositories\AuthRepository;
use App\Repositories\BudgetRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\Contracts\AccountRepositoryInterface;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\BudgetRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\DashboardRepositoryInterface;
use App\Repositories\Contracts\OTPMailRepositoryInterface;
use App\Repositories\Contracts\RecurringTransactionRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\TransferRepositoryInterface;
use App\Repositories\Contracts\UserProfileRepositoryInterface;
use App\Repositories\DashboardRepository;
use App\Repositories\OTPMailRepository;
use App\Repositories\RecurringTransactionRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\TransferRepository;
use App\Repositories\UserProfileRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );
        $this->app->bind(
            AccountRepositoryInterface::class,
            AccountRepository::class
        );
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            TransactionRepositoryInterface::class,
            TransactionRepository::class
        );
        $this->app->bind(
            TransferRepositoryInterface::class,
            TransferRepository::class
        );
        $this->app->bind(
            BudgetRepositoryInterface::class,
            BudgetRepository::class
        );
        $this->app->bind(
            RecurringTransactionRepositoryInterface::class,
            RecurringTransactionRepository::class
        );
        $this->app->bind(
            DashboardRepositoryInterface::class,
            DashboardRepository::class
        );
        $this->app->bind(
            OTPMailRepositoryInterface::class,
            OTPMailRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
