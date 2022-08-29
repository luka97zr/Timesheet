<?php

namespace App\Providers;

use App\Http\Controllers\CalendarController;
use App\Http\Requests\CategoryRequest;
use App\Models\Client;
use App\Observers\ClientObserver;
use App\Repository\CategoryRepository;
use App\Repository\ClientRepository;
use App\Repository\Interface\CategoryRepositoryInterface;
use App\Repository\Interface\ClientRepositoryInterface;
use App\Repository\Interface\ProjectRepositoryInterface;
use App\Repository\ProjectRepository;
use App\Services\ExcelService;
use App\Services\Interface\ExportServiceInterface;
use App\Services\PdfService;
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
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
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
