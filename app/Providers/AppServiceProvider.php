<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // require_once base_path().'/app/Http/Controllers/Library/Lib.php';
        // View::composer('*', function ($view) {
        //     if (auth()->check()) {
        //         $view->with([
        //             'menulist' => MenuController::menuDashboard()
        //         ]);
        //     }
        // });
    }
}
