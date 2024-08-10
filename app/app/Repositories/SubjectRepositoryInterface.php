<?php

namespace App\Repositories;

use App\DTO\CreateSubjectDTO;
use App\DTO\UpdateSubjectDTO;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

interface SubjectRepositoryInterface
{
    public function getAll(string $filter = null): Collection;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function create(CreateSubjectDTO $dto): Subject;
    public function update(UpdateSubjectDTO $dto): stdClass|null;
}
