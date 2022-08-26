<?php

namespace App\Providers;

use App\Services\PdfService;
use Illuminate\Support\ServiceProvider;

class ExportPdfServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(PdfService::class, function() {
           return new PdfService($this->app['excel']);
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
