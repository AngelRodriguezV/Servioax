<?php

namespace App\Providers;

use App\Events\SolicitudEvent;
use App\Listeners\SolicitudListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\SomeEvent;
use App\Listeners\SomeEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SomeEvent::class => [
            SomeEventListener::class,
        ],
        SolicitudEvent::class => [
            SolicitudListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        parent::boot();
    }
}
