<?php

namespace App\Repositories;

use App\DTO\CreateAutorDTO;
use App\DTO\CreateLivroDTO;
use App\DTO\RelatorioLivroDTO;
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

    public function findBy(RelatorioLivroDTO $dto): Collection|null
    {
        $dbQuery = $this->modelLivro
            ->with('assuntos', 'autores')
            ->join('livro_assunto', 'livro.codl', '=', 'livro_assunto.livro_codl')
            ->join('assunto', 'livro_assunto.assunto_codAs', '=', 'assunto.codAs')
            ->join('livro_autor', 'livro.codl', '=', 'livro_autor.livro_codl')
            ->join('autor', 'livro_autor.autor_codAu', '=', 'autor.codAu');

        if( !is_null($dto->titulo) ) {
            $titulo = $dto->titulo;
            $dbQuery->where(function ($query) use ($titulo) {
                    $query->where('titulo', 'like', "%$titulo%");
            });
        }

        if( !is_null($dto->editora) ) {
            $editora = $dto->editora;
            $dbQuery->where(function ($query) use ($editora) {
                $query->where('editora', 'like', "%$editora%");
            });
        }

        if( !is_null($dto->edicao) ) {
            $edicao = $dto->edicao;
            $dbQuery->where(function ($query) use ($edicao) {
                $query->where('edicao', 'like', "%$edicao%");
            });
        }

        if( !is_null($dto->anoPublicacao) ) {
            $dbQuery->where(['anoPublicacao' => $dto->anoPublicacao]);
        }

        if( !is_null($dto->assuntos) ) {
            $dbQuery->whereIn('assunto.codAs', $dto->assuntos);
        }

        if( !is_null($dto->autores) ) {
            $dbQuery->whereIn('autor.codAu', $dto->autores);
        }


        $dbQuery->orderby('titulo');
        return $dbQuery->get();
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
