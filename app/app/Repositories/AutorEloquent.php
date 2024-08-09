<?php

namespace App\Repositories;

use App\DTO\CreateAutorDTO;
use App\DTO\UpdateAutorDTO;
use App\Models\Autor;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

class AutorEloquent implements AutorRepositoryInterface
{

    public function __construct(
        protected Autor $model
    )
    { }

    public function getAll(string $filter = null): Collection
    {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if($filter) {
                            $query->where('nome', 'like', "%$filter%");
                        }
                    })
                    ->orderby('nome')
                    ->get();
    }

    public function findOne(string $id): stdClass|null
    {
        $autor = $this->model->find($id);

        if( !$autor ) {
            return null;
        }

        return (object) $autor->toArray();
    }

    public function delete(string $id): void
    {
        $this->model->findOrFail($id)->delete();
    }

    public function create(CreateAutorDTO $dto): Autor
    {
        $autor = $this->model->create( (array) $dto );
        return $autor;
    }

    public function update(UpdateAutorDTO $dto): stdClass|null
    {
        if( !$autor = $this->model->find($dto->codAu) ) {
            return null;
        }

        $autor->update(
            (array) $dto
        );

        return (object) $autor->toArray();
    }

}
