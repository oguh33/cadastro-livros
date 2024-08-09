<?php

namespace App\Repositories;

use App\DTO\RelatorioLivroDTO;
use Illuminate\Support\Collection;

interface RelatorioVwRepositoryInterface
{
    public function findBy(RelatorioLivroDTO $dto): Collection|null;
}
