<?php

namespace App\Providers;

use App\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::routes();

        Passport::tokensExpireIn(now()->addDays(30));
        Passport::refreshTokensExpireIn(now()->addDays(60));

        view()->composer('layout.navigation', function($view){
            if (Auth::check() && Auth::user()->is_admin == 1){
                $view->with('menuItems', Menu::where('type', 'admin')->orderBy('sort_order')->get());
            }else{
                $view->with('menuItems', Menu::where('type', 'front')->orderBy('sort_order')->get());
            }
        });
    }
}
