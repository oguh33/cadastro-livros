<?php

namespace App\Services;

use App\DTO\CreateSubjectDTO;
use App\DTO\UpdateSubjectDTO;
use App\Models\Subject;
use App\Repositories\SubjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

class SubjectService
{

    public function __construct(
        protected SubjectRepositoryInterface $repository
    ) {}

    public function getAll(string $filter = null): Collection
    {
        return $this->repository->getAll($filter);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateSubjectDTO $dto): Subject
    {
        return $this->repository->create($dto);
    }

    public function update(UpdateSubjectDTO $dto): stdClass|null
    {
        return $this->repository->update($dto);
    }

    public function delete(string $id): void
    {
        $this->repository->delete($id);
    }

}
