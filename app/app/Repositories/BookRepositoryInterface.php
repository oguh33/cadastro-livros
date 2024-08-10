<?php

namespace App\Repositories;

use App\DTO\CreateBookDTO;
use App\DTO\RelatorioLivroDTO;
use App\DTO\UpdateBookDTO;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

interface BookRepositoryInterface
{
    public function getAll(string $filter = null): Collection;
    public function findOne(string $id): Book|null;
    public function delete(string $id): void;
    public function create(CreateBookDTO $dto): Book;
    public function update(UpdateBookDTO $dto): Book|null;
}
