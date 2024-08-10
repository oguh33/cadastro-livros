<?php

namespace App\Services;

use App\DTO\CreateBookDTO;
use App\DTO\UpdateBookDTO;
use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class BookService
{

    public function __construct(
        protected BookRepositoryInterface $repository
    ) {}

    public function getAll(string $filter = null): Collection
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): Book|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateBookDTO $dto): Book
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateBookDTO $dto): Book|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
