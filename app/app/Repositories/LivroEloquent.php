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
        try {

            return $this->modelLivro
                ->with('assuntos', 'autores')
                ->where(function ($query) use ($filter) {
                    if($filter) {
                        $query->where('titulo', 'like', "%$filter%");
                    }
                })
                ->orderby('titulo')
                ->get();
        } catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao consultar os livros");
        }
    }

    public function findOne(string $id): Livro|null
    {
        try {

            $livro = $this->modelLivro->with('assuntos', 'autores')->find($id);

            if( !$livro ) {
                throw new \Exception("Não foi possível encontrar o livro ($id)");
            }

            return $livro;

        } catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao consulta o livro");
        }
    }

    public function delete(string $id): void
    {
        try {

            $livro = $this->modelLivro->find($id);
            if( !$livro ) {
                throw new \Exception("Não foi possível remover. Erro ao consular o livro ($id)");
            }
            $livro->assuntos()->detach();
            $livro->autores()->detach();
            $livro->delete();

        } catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao excluir o livro ($id)");
        }
    }

    public function create(CreateLivroDTO $dto): Livro
    {
        try {

            $livro = $this->modelLivro->create([
                'titulo' => $dto->titulo,
                'editora' => $dto->editora,
                'edicao' => $dto->edicao,
                'anoPublicacao' => $dto->anoPublicacao,
                'valor' => $dto->valor
            ]);

            if( !$livro ) {
                throw new \Exception("Não foi possível cadastrar o livro");
            }

            foreach ($dto->autor_codAu as $autorCodAu) {
                $autor = $this->modelAutor->find($autorCodAu);
                if( !$autor ) {
                    throw new \Exception("Não foi possível vincular o autor ao livro");
                }

                $autores[] = $autor->codAu;
            }
            $livro->autores()->attach($autores);

            $assunto = Assunto::find($dto->assunto_codAs);
            if( !$assunto ) {
                throw new \Exception("Não foi possível vincular o assunto ao livro");
            }
            $assuntos[] = $assunto->codAs;
            $livro->assuntos()->attach($assuntos);

            return $livro;

        } catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao cadastrar o livro");
        }

    }

    public function update(UpdateLivroDTO $dto): Livro|null
    {
        try {

            if( !$livro = $this->modelLivro->find($dto->codl) ) {
                throw new \Exception("Não foi possível encontrar o livro para editar.");
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

        }catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao editar o livro");
        }
    }

}
