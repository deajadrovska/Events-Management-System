<?php

namespace App\Http\Controllers;

use App\Enums\EventTypeEnum;
use App\Models\Organizer;
use App\Repositories\Contracts\EventRepositoryInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected EventRepositoryInterface $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function index(Request $request)
    {
        $filters = [
            'type' => $request->type,
            'search' => $request->search,
        ];

        $events = $this->eventRepository->all($filters);

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

        $this->eventRepository->create($validated);

        return redirect()->route('events.index');
    }

    public function show(int $id)
    {
        $event = $this->eventRepository->find($id);

        if (!$event) {
            abort(404);
        }

        return view('events.show', compact('event'));
    }

    public function edit(int $id)
    {
        $event = $this->eventRepository->find($id);

        if (!$event) {
            abort(404);
        }

        $organizers = Organizer::all();
        return view('events.edit', compact('event', 'organizers'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'date' => 'required|date|after_or_equal:today',
            'type' => 'required|in:' . implode(',', array_column(EventTypeEnum::cases(), 'value')),
            'organizer_id' => 'required|exists:organizers,id',
        ]);

        $this->eventRepository->update($id, $validated);

        return redirect()->route('events.index');
    }

    public function destroy(int $id)
    {
        $this->eventRepository->delete($id);

        return redirect()->route('events.index');
    }
}
