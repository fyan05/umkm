<?php

namespace App\Providers;

use App\Models\member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        //
         View::composer('*', function ($view) {
        if (Auth::check()) {
            $member = member::where('users_id', Auth::id())->first();
            $view->with('member', $member);
        }
    });
    }
}
