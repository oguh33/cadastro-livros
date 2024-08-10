<?php

namespace App\Services;

use App\DTO\CreateAuthorDTO;
use App\DTO\UpdateAuthorDTO;
use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

class AuthorService
{

    public function __construct(
        protected AuthorRepositoryInterface $repository
    ) {}

    public function getAll(string $filter = null): Collection
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateAuthorDTO $dto): Author
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateAuthorDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
