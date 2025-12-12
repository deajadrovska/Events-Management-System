<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Organizer;
use App\Observers\EventObserver;
use App\Observers\OrganizerObserver;
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
        Organizer::observe(OrganizerObserver::class);
        Event::observe(EventObserver::class);
    }
}
