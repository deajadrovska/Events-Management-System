<?php

namespace App\Repositories;

use App\Models\Event;
use App\Repositories\Contracts\EventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EventRepository implements EventRepositoryInterface
{
    public function all(array $filters = []): LengthAwarePaginator
    {
        $query = Event::with('organizer');

        if (isset($filters['type']) && $filters['type']) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['search']) && $filters['search']) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->paginate(10);
    }

    public function find(int $id): ?Event
    {
        return Event::with('organizer')->find($id);
    }

    public function create(array $data): Event
    {
        return Event::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $event = Event::find($id);

        if (!$event) {
            return false;
        }

        return $event->update($data);
    }

    public function delete(int $id): bool
    {
        $event = Event::find($id);

        if (!$event) {
            return false;
        }

        return $event->delete();
    }

    public function filterByType(?string $type): LengthAwarePaginator
    {
        $query = Event::with('organizer');

        if ($type) {
            $query->where('type', $type);
        }

        return $query->paginate(10);
    }

    public function searchByName(?string $search): LengthAwarePaginator
    {
        $query = Event::with('organizer');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }
}
