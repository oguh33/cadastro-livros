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
        try {

            return $this->model
                ->where(function ($query) use ($filter) {
                    if($filter) {
                        $query->where('descricao', 'like', "%$filter%");
                    }
                })
                ->orderby('descricao')
                ->get();
        } catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao consultar os assuntos");
        }
    }

    public function findOne(string $id): stdClass|null
    {
        try {

            $autor = $this->model->find($id);

            if( !$autor ) {
                throw new \Exception("Não foi possível encontrar o assunto: ($id)");
            }

            return (object) $autor->toArray();
        }catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao consultar o assunto: ($id)");
        }
    }

    public function delete(string $id): void
    {
        try {

            $this->model->findOrFail($id)->delete();

        }catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao excluir o assunto");
        }
    }

    public function create(CreateAssuntoDTO $dto): Assunto
    {
        try {
            $assunto = $this->model->create( (array) $dto );
            return $assunto;
        }catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao cadastrar o novo assunto");
        }
    }

    public function update(UpdateAssuntoDTO $dto): stdClass|null
    {
        try {

            if( !$assunto = $this->model->find($dto->codAs) ) {
                throw new \Exception("Não foi possível encontrar o assunto ($dto->codAs) ao editar.");
            }

            $assunto->update(
                (array) $dto
            );

            return (object) $assunto->toArray();
        }catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao editar o assunto");
        }
    }

}
