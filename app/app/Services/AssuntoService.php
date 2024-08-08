<?php

namespace App\Services;

use App\DTO\CreateAssuntoDTO;
use App\DTO\CreateAutorDTO;
use App\DTO\UpdateAssuntoDTO;
use App\DTO\UpdateAutorDTO;
use App\Models\Assunto;
use App\Models\Autor;
use App\Repositories\AssuntoRepositoryInterface;
use App\Repositories\AutorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

class AssuntoService
{

    public function __construct(
        protected AssuntoRepositoryInterface $repository
    ) {}

    public function getAll(string $filter = null): Collection
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateAssuntoDTO $dto): Assunto
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateAssuntoDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
