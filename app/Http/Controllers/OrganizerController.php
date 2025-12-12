<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrganizerRepositoryInterface;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    protected OrganizerRepositoryInterface $organizerRepository;

    public function __construct(OrganizerRepositoryInterface $organizerRepository)
    {
        $this->organizerRepository = $organizerRepository;
    }

    public function index()
    {
        $organizers = $this->organizerRepository->all();
        return view('organizers.index', compact('organizers'));
    }

    public function create()
    {
        return view('organizers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizers,email',
            'phone_number' => 'required|string|max:20',
        ]);

        $this->organizerRepository->create($validated);

        return redirect()->route('organizers.index');
    }

    public function show(int $id)
    {
        $organizer = $this->organizerRepository->getWithEvents($id);

        if (!$organizer) {
            abort(404);
        }

        return view('organizers.show', compact('organizer'));
    }

    public function edit(int $id)
    {
        $organizer = $this->organizerRepository->find($id);

        if (!$organizer) {
            abort(404);
        }

        return view('organizers.edit', compact('organizer'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizers,email,' . $id,
            'phone_number' => 'required|string|max:20',
        ]);

        $this->organizerRepository->update($id, $validated);

        return redirect()->route('organizers.index');
    }

    public function destroy(int $id)
    {
        $this->organizerRepository->delete($id);

        return redirect()->route('organizers.index');
    }
}
