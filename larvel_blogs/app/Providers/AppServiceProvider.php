<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Session;

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
        //redirect an authenticated user to the dashboard
        RedirectIfAuthenticated::redirectUsing(
            function(){
                return route('admin.dashboard');
            }

        );

        //Redirect non authenticated users to the dashboard
        Authenticate::redirectUsing(
            function(){
                Session::flash('fail','You must be logged in');
                return route('admin.login');
            }
        );

        //Set session lifetime to 1 hour
        //Session::put('session.lifetime', 60 * 60);
    }
}
