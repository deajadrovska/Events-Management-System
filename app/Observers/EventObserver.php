<?php

namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Log;

class EventObserver
{
    /**
     * Handle the Event "created" event.
     */
    public function created(Event $event): void
    {
        Log::info("Нов настан е додаден: {$event->name} (ID: {$event->id}, Датум: {$event->date->format('d.m.Y')})");

        session()->flash('success', "Настанот '{$event->name}' е успешно креиран!");
    }

    /**
     * Handle the Event "updated" event.
     */
    public function updated(Event $event): void
    {
        $changes = [];

        if ($event->wasChanged('date')) {
            $changes[] = "датумот е променет на {$event->date->format('d.m.Y')}";
        }

        if ($event->wasChanged('name')) {
            $changes[] = "името е променето на '{$event->name}'";
        }

        if ($event->wasChanged('type')) {
            $changes[] = "типот е променет на '{$event->type->value}'";
        }

        $changeLog = !empty($changes) ? ' (' . implode(', ', $changes) . ')' : '';

        Log::info("Настанот е ажуриран: {$event->name} (ID: {$event->id}){$changeLog}");

        session()->flash('success', "Настанот '{$event->name}' е успешно ажуриран!");
    }

    /**
     * Handle the Event "deleted" event.
     */
    public function deleted(Event $event): void
    {
        Log::warning("Настанот е откажан/избришан: {$event->name} (ID: {$event->id}, Датум: {$event->date->format('d.m.Y')})");

        session()->flash('success', "Настанот '{$event->name}' е успешно избришан!");
    }

    /**
     * Handle the Event "restored" event.
     */
    public function restored(Event $event): void
    {
        Log::info("Настанот е вратен: {$event->name} (ID: {$event->id})");
    }

    /**
     * Handle the Event "force deleted" event.
     */
    public function forceDeleted(Event $event): void
    {
        Log::critical("Настанот е трајно избришан: {$event->name} (ID: {$event->id})");
    }
}
