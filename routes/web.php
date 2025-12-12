<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('organizers.index');
});

Route::resource('organizers', OrganizerController::class);
Route::resource('events', EventController::class);
