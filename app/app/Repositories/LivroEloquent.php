<?php

namespace App\Repositories;

use App\DTO\CreateAutorDTO;
use App\DTO\CreateLivroDTO;
use App\DTO\UpdateAutorDTO;
use App\DTO\UpdateLivroDTO;
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
                    ->with('assuntos', 'autores')
                    ->where(function ($query) use ($filter) {
                        if($filter) {
                            $query->where('titulo', 'like', "%$filter%");
                        }
                    })
                    ->orderby('titulo')
                    ->get();
    }

    public function findOne(string $id): Livro|null
    {
        $livro = $this->modelLivro->with('assuntos', 'autores')->find($id);

        if( !$livro ) {
            return null;
        }

        return $livro;
    }

    public function delete(string $id): void
    {
        $livro = $this->modelLivro->find($id);
        $livro->assuntos()->detach();
        $livro->autores()->detach();
        $livro->delete();
    }

    public function create(CreateLivroDTO $dto): Livro
    {

            $livro = $this->modelLivro->create([
                'titulo' => $dto->titulo,
                'editora' => $dto->editora,
                'edicao' => $dto->edicao,
                'anoPublicacao' => $dto->anoPublicacao,
                'valor' => $dto->valor
            ]);

            foreach ($dto->autor_codAu as $autorCodAu) {
                $autor = $this->modelAutor->find($autorCodAu);
                $autores[] = $autor->codAu;
            }
            $livro->autores()->attach($autores);

            $assunto = Assunto::find($dto->assunto_codAs);
            $assuntos[] = $assunto->codAs;
            $livro->assuntos()->attach($assuntos);

            return $livro;
    }

    public function update(UpdateLivroDTO $dto): Livro|null
    {
        if( !$livro = $this->modelLivro->find($dto->codl) ) {
            return null;
        }

        $livro->update([
            'titulo' => $dto->titulo,
            'editora' => $dto->editora,
            'edicao' => $dto->edicao,
            'anoPublicacao' => $dto->anoPublicacao,
            'valor' => $dto->valor
        ]);

        $autores = $dto->autor_codAu;
        $assuntos = $dto->assunto_codAs;
        if( !is_array($assuntos) ) {
            $assuntos = [$assuntos];
        }

        $livro->assuntos()->sync($assuntos);
        $livro->autores()->sync($autores);

        return $livro;
    }

}
