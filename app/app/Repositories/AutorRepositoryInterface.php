<?php

namespace App\Repositories;

use App\DTO\CreateAutorDTO;
use App\DTO\UpdateAutorDTO;
use App\Models\Autor;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

interface AutorRepositoryInterface
{
    public function getAll(string $filter = null): Collection;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function create(CreateAutorDTO $dto): Autor;
    public function update(UpdateAutorDTO $dto): stdClass|null;
}
