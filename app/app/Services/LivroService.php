<?php

namespace App\Services;

use App\DTO\CreateLivroDTO;
use App\DTO\UpdateLivroDTO;
use App\Models\Livro;
use App\Repositories\LivroRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class LivroService
{

    public function __construct(
        protected LivroRepositoryInterface $repository
    ) {}

    public function getAll(string $filter = null): Collection
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): Livro|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateLivroDTO $dto): Livro
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateLivroDTO $dto): Livro|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
