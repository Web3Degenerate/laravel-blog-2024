<?php

namespace App\Providers;

// (5:20) Must uncomment reference to Gate provided by laravel: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426458#overview
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    // Added (7:55): https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426438#overview
    protected $policies = [
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */

// (3:30) - set up 'Gate': https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426458#overview
    // public function boot(): void //OUR version had void
    public function boot() 
    {
        //our version missing '$this->registerPolicies();
        $this->registerPolicies();

        //spell out our gate: 
        // Gate::define('label', function)
        Gate::define('visitAdminPages', function($user){
            return $user->isAdmin === 1;
        });
    }
}
