<?php

namespace App\Repositories;

use App\DTO\CreateAutorDTO;
use App\DTO\UpdateAutorDTO;
use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

class LivroEloquent implements LivroRepositoryInterface
{

    public function __construct(
        protected Livro $modelLivro,
        protected Autor $modelAutor,
        protected Assunto $modelAssunto,
    )
    { }

    public function getAll(string $filter = null): Collection
    {
        return $this->modelLivro
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
        $autor = $this->modelLivro->find($id);

        if( !$autor ) {
            return null;
        }

        return (object) $autor->toArray();
    }

    public function delete(string $id): void
    {
        $this->modelLivro->findOrFail($id)->delete();
    }

    public function create(CreateAutorDTO $dto): Autor
    {
        $livro = $this->modelLivro->create( (array) $dto );
        return $livro;
    }

    public function update(UpdateAutorDTO $dto): stdClass|null
    {
        if( !$livro = $this->modelLivro->find($dto->codl) ) {
            return null;
        }

        $livro->update(
            (array) $dto
        );

        return (object) $livro->toArray();
    }

}
