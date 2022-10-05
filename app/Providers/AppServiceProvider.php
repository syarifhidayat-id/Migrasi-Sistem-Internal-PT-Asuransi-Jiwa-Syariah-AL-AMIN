<?php

namespace App\Providers;

use App\Http\Controllers\Utility\MenuController;
use App\Models\User;
use App\Models\Utility\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $view->with([
                    'menulist' => MenuController::menuDashboard()
                ]);
            }
        });
    }
}
