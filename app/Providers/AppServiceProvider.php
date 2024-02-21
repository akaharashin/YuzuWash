<?php

namespace App\Providers;

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
        View::composer('*', function($view) {
             $view->with('carbonDate', function($var) {
                return \Carbon\Carbon::parse($var)->locale('id')->isoFormat('dddd - DD MMMM YYYY');
             });

             $view->with('carbonDateTime', function($var) {
                return \Carbon\Carbon::parse($var)->locale('id')->isoFormat("dddd, DD MMMM YYYY HH:mm");
             });
        });
    }
}
