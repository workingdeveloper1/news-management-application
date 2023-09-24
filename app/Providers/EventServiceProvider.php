<?php

namespace App\Providers;

use App\Events\SuccessCreateNews;
use App\Events\SuccessDeleteNews;
use App\Events\SuccessUpdateNews;
use App\Listeners\StoreLogSuccessCreateNews;
use App\Listeners\StoreLogSuccessDeleteNews;
use App\Listeners\StoreLogSuccessUpdateNews;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SuccessCreateNews::class => [
            StoreLogSuccessCreateNews::class
        ],
        SuccessDeleteNews::class => [
            StoreLogSuccessDeleteNews::class
        ],
        SuccessUpdateNews::class => [
            StoreLogSuccessUpdateNews::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
