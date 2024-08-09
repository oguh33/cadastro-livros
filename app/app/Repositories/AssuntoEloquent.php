<?php

namespace App\Repositories;

use App\DTO\CreateAssuntoDTO;
use App\DTO\UpdateAssuntoDTO;
use App\DTO\UpdateAutorDTO;
use App\Models\Assunto;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

class AssuntoEloquent implements AssuntoRepositoryInterface
{

    public function __construct(
        protected Assunto $model
    )
    { }

    public function getAll(string $filter = null): Collection
    {
        return $this->model
                    ->where(function ($query) use ($filter) {
                        if($filter) {
                            $query->where('descricao', 'like', "%$filter%");
                        }
                    })
                    ->orderby('descricao')
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

    public function create(CreateAssuntoDTO $dto): Assunto
    {
        $assunto = $this->model->create( (array) $dto );
        return $assunto;
    }

    public function update(UpdateAssuntoDTO $dto): stdClass|null
    {
        if( !$assunto = $this->model->find($dto->codAs) ) {
            return null;
        }

        $assunto->update(
            (array) $dto
        );

        return (object) $assunto->toArray();
    }

}
