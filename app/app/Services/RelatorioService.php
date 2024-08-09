<?php

namespace App\Services;

use App\DTO\RelatorioLivroDTO;
use App\Repositories\RelatorioVwRepositoryInterface;
use Illuminate\Support\Collection;

class RelatorioService
{

    public function __construct(
        protected RelatorioVwRepositoryInterface $repository
    ) {}

    public function findBy(RelatorioLivroDTO $dto): Collection|null
    {
        return $this->repository->findBy($dto);
    }

}
