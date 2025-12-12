<?php

namespace App\Http\Controllers;

//use App\EventTypeEnum;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use App\Enums\EventTypeEnum;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::with('organizer');

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $organizers = Organizer::all();
        return view('events.create', compact('organizers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'date' => 'required|date|after_or_equal:today',
            'type' => 'required|in:' . implode(',', array_column(EventTypeEnum::cases(), 'value')),
            'organizer_id' => 'required|exists:organizers,id',
        ]);

        Event::create($validated);

        return redirect()->route('events.index');
    }

    public function show(Event $event)
    {
        $event->load('organizer');
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $organizers = Organizer::all();
        return view('events.edit', compact('event', 'organizers'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'date' => 'required|date|after_or_equal:today',
            'type' => 'required|in:' . implode(',', array_column(EventTypeEnum::cases(), 'value')),
            'organizer_id' => 'required|exists:organizers,id',
        ]);

        $event->update($validated);

        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index');
    }
}
