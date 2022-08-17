<?php

namespace App\Providers;

use App\Http\Controllers\CalendarController;
use App\Models\Client;
use App\Observers\ClientObserver;
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
        view()->composer(
            '/',
            function($view) {
                $view->with('test',[CalendarController::class,'store']);
            }
        );
    }
}
