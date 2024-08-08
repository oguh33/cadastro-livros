<?php

namespace App\Services;

use App\DTO\CreateAutorDTO;
use App\DTO\UpdateAutorDTO;
use App\Models\Autor;
use App\Repositories\LivroRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

class LivroService
{

    public function __construct(
        protected LivroRepositoryInterface $repository
    ) {}

    public function getAll(string $filter = null): Collection
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateAutorDTO $dto): Autor
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateAutorDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
