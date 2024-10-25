<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use App\Services\Robokassa\Contracts\ClientContract;
use App\Services\Robokassa\Contracts\ServiceContract;
use App\Services\Robokassa\RobokassaClient;
use App\Services\Robokassa\RobokassaService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        Paginator::defaultView('vendor.pagination.custom');
        Schema::defaultStringLength(125);
        ini_set('max_execution_time', 1000);
        ini_set('memory_limit', '256M');
        $this->app->singleton(ClientContract::class, RobokassaClient::class);
        $this->app->singleton(ServiceContract::class, RobokassaService::class);
    }
}
