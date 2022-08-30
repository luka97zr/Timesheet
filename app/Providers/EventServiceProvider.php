<?php

namespace App\Providers;

use App\Events\UpdatePassword;
use App\Listeners\SendUserVerifyNotification;
use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use App\Observers\CategoryObserver;
use App\Observers\ClientObserver;
use App\Observers\EmployeeObserver;
use App\Observers\ProjectObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UpdatePassword::class => [
            SendUserVerifyNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Client::observe(ClientObserver::class);
        Project::observe(ProjectObserver::class);
        Category::observe(CategoryObserver::class);
        User::observe(EmployeeObserver::class);
    }
}
