<?php

namespace App\Repositories;

use App\Models\Organizer;
use App\Repositories\Contracts\OrganizerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrganizerRepository implements OrganizerRepositoryInterface
{
    public function all(): LengthAwarePaginator
    {
        return Organizer::paginate(10);
    }

    public function find(int $id): ?Organizer
    {
        return Organizer::find($id);
    }

    public function create(array $data): Organizer
    {
        return Organizer::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $organizer = $this->find($id);

        if (!$organizer) {
            return false;
        }

        return $organizer->update($data);
    }

    public function delete(int $id): bool
    {
        $organizer = $this->find($id);

        if (!$organizer) {
            return false;
        }

        return $organizer->delete();
    }

    public function getWithEvents(int $id): ?Organizer
    {
        return Organizer::with('events')->find($id);
    }
}
