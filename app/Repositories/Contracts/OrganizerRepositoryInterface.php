<?php

namespace App\Repositories\Contracts;

use App\Models\Organizer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrganizerRepositoryInterface
{
    public function all(): LengthAwarePaginator;

    public function find(int $id): ?Organizer;

    public function create(array $data): Organizer;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function getWithEvents(int $id): ?Organizer;
}
