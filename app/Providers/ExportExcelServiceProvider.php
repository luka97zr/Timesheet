<?php

namespace App\Providers;

use App\Services\ExcelService;
use Illuminate\Support\ServiceProvider;

class ExportExcelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExcelService::class, function() {
            return new ExcelService($this->app['excel']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
