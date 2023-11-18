<?php

namespace App\Repositories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Nette\NotImplementedException;
use Symfony\Component\HttpFoundation\Response;

class RoomRepository extends BaseRepository
{
    public function __construct(private readonly Room $room)
    {
    }

    public function store(array $attributes): Model
    {
        throw new NotImplementedException('Not implemented', Response::HTTP_NOT_IMPLEMENTED);
    }

    public function update(int $id, array $attributes): Model|bool
    {
        throw new NotImplementedException('Not implemented', Response::HTTP_NOT_IMPLEMENTED);
    }

    public function destroy(int $id): bool
    {
        throw new NotImplementedException('Not implemented', Response::HTTP_NOT_IMPLEMENTED);
    }

    public function all(): Collection
    {
        return $this->room->all();
    }
}
