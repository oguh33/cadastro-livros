<?php

namespace App\Repositories;

use App\DTO\CreateAssuntoDTO;
use App\DTO\UpdateAssuntoDTO;
use App\Models\Assunto;
use App\Models\Autor;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

interface AssuntoRepositoryInterface
{
    public function getAll(string $filter = null): Collection;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function create(CreateAssuntoDTO $dto): Assunto;
    public function update(UpdateAssuntoDTO $dto): stdClass|null;
}
