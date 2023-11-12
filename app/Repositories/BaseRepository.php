<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    abstract public function store(array $attributes): Model;

    abstract public function update(int $id, array $attributes): Model|bool;

    abstract public function destroy(int $id): bool;

    abstract public function all(): Collection;
}
