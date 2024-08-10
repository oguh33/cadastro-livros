<?php

namespace App\Repositories;

use App\DTO\CreateAuthorDTO;
use App\DTO\UpdateAuthorDTO;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

interface AuthorRepositoryInterface
{
    public function getAll(string $filter = null): Collection;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function create(CreateAuthorDTO $dto): Author;
    public function update(UpdateAuthorDTO $dto): stdClass|null;
}
