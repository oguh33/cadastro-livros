<?php

namespace App\Repositories;

use App\DTO\CreateLivroDTO;
use App\DTO\UpdateLivroDTO;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Collection;

interface LivroRepositoryInterface
{
    public function getAll(string $filter = null): Collection;
    public function findOne(string $id): Livro|null;
    public function delete(string $id): void;
    public function create(CreateLivroDTO $dto): Livro;
    public function update(UpdateLivroDTO $dto): Livro|null;
}
