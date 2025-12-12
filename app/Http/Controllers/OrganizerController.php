<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organizers = Organizer::paginate(10);
        return view('organizers.index', compact('organizers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organizers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizers,email',
            'phone_number' => 'required|string|max:20',
        ]);

        Organizer::create($validated);

        return redirect()->route('organizers.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Organizer $organizer)
    {
        $organizer->load('events');
        return view('organizers.show', compact('organizer'));
    }

    public function edit(Organizer $organizer)
    {
        return view('organizers.edit', compact('organizer'));
    }

    public function update(Request $request, Organizer $organizer)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizers,email,' . $organizer->id,
            'phone_number' => 'required|string|max:20',
        ]);

        $organizer->update($validated);

        return redirect()->route('organizers.index');
    }

    public function destroy(Organizer $organizer)
    {
        $organizer->delete();

        return redirect()->route('organizers.index');
    }
}
