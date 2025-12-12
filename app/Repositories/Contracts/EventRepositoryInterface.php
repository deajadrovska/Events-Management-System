<?php

namespace App\Repositories\Contracts;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EventRepositoryInterface
{
    public function all(array $filters = []): LengthAwarePaginator;

    public function find(int $id): ?Event;

    public function create(array $data): Event;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function filterByType(?string $type): LengthAwarePaginator;

    public function searchByName(?string $search): LengthAwarePaginator;
}
