<?php

namespace App\Observers;

use App\Models\Organizer;
use Illuminate\Support\Facades\Log;

class OrganizerObserver
{
    /**
     * Handle the Organizer "created" event.
     */
    public function created(Organizer $organizer): void
    {
        Log::info("Нов организатор е креиран: {$organizer->full_name} (ID: {$organizer->id})");

        // You can also add a session flash message for user notification
        session()->flash('success', "Организаторот {$organizer->full_name} е успешно креиран!");
    }

    /**
     * Handle the Organizer "updated" event.
     */
    public function updated(Organizer $organizer): void
    {
        Log::info("Организаторот е ажуриран: {$organizer->full_name} (ID: {$organizer->id})");

        session()->flash('success', "Организаторот {$organizer->full_name} е успешно ажуриран!");
    }

    /**
     * Handle the Organizer "deleted" event.
     */
    public function deleted(Organizer $organizer): void
    {
        Log::warning("Организаторот е избришан: {$organizer->full_name} (ID: {$organizer->id})");

        session()->flash('success', "Организаторот {$organizer->full_name} е успешно избришан!");
    }

    /**
     * Handle the Organizer "restored" event.
     */
    public function restored(Organizer $organizer): void
    {
        Log::info("Организаторот е вратен: {$organizer->full_name} (ID: {$organizer->id})");
    }

    /**
     * Handle the Organizer "force deleted" event.
     */
    public function forceDeleted(Organizer $organizer): void
    {
        Log::critical("Организаторот е трајно избришан: {$organizer->full_name} (ID: {$organizer->id})");
    }
}
