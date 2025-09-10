<?php

namespace App\Providers;

use App\Listeners\UpdateLastLoginAt;
use App\Models\User;
use App\Policies\Admin;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $listen = [
            Login::class => [
                UpdateLastLoginAt::class
            ]
    ];
    
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Gate::policy(User::class, Admin::class);
        Gate::define('admin-only', function(User $user){
            return $user->role === 'admin';
        });

        Gate::define('user-only', function(User $user){
            return $user->role === 'employee';
        });
    }
}
