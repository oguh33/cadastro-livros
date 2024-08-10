<?php

namespace App\Repositories;

use App\DTO\CreateAuthorDTO;
use App\DTO\CreateBookDTO;
use App\DTO\RelatorioLivroDTO;
use App\DTO\UpdateAuthorDTO;
use App\DTO\UpdateBookDTO;
use App\Models\Subject;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use \stdClass;

class BookEloquent implements BookRepositoryInterface
{

    public function __construct(
        protected Book    $modelBook,
        protected Author  $modelAuthor,
        protected Subject $modelSubject,
    )
    { }

    public function getAll(string $filter = null): Collection
    {
        try {

            return $this->modelBook
                ->with('subjects', 'authors')
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

    public function findOne(string $id): Book|null
    {
        try {

            $book = $this->modelBook->with('subjects', 'authors')->find($id);

            if( !$book ) {
               return null;
            }

            return $book;

        } catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao consulta o livro");
        }
    }

    public function delete(string $id): void
    {
        try {

            $book = $this->modelBook->find($id);
            if( !$book ) {
                throw new \Exception("Não foi possível remover. Erro ao consular o livro ($id)");
            }
            $book->subjects()->detach();
            $book->authors()->detach();
            $book->delete();

        } catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao excluir o livro ($id)");
        }
    }

    public function create(CreateBookDTO $dto): Book
    {
        try {

            $book = $this->modelBook->create([
                'titulo' => $dto->titulo,
                'editora' => $dto->editora,
                'edicao' => $dto->edicao,
                'anoPublicacao' => $dto->anoPublicacao,
                'valor' => $dto->valor
            ]);

            if( !$book ) {
                throw new \Exception("Não foi possível cadastrar o livro");
            }

            foreach ($dto->autor_codAu as $autorCodAu) {
                $author = $this->modelAuthor->find($autorCodAu);
                if( !$author ) {
                    throw new \Exception("Não foi possível vincular o autor ao livro");
                }

                $authors[] = $author->codAu;
            }
            $book->authors()->attach($authors);

            $subject = Subject::find($dto->assunto_codAs);
            if( !$subject ) {
                throw new \Exception("Não foi possível vincular o assunto ao livro");
            }
            $subjects[] = $subject->codAs;
            $book->subjects()->attach($subjects);

            return $book;

        } catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao cadastrar o livro");
        }

    }

    public function update(UpdateBookDTO $dto): Book|null
    {
        try {

            if( !$book = $this->modelBook->find($dto->codl) ) {
                throw new \Exception("Não foi possível encontrar o livro para editar.");
            }

            $book->update([
                'titulo' => $dto->titulo,
                'editora' => $dto->editora,
                'edicao' => $dto->edicao,
                'anoPublicacao' => $dto->anoPublicacao,
                'valor' => $dto->valor
            ]);

            $authors = $dto->autor_codAu;
            $subjects = $dto->assunto_codAs;
            if( !is_array($subjects) ) {
                $subjects = [$subjects];
            }

            $book->subjects()->sync($subjects);
            $book->authors()->sync($authors);

            return $book;

        }catch (\Exception $e) {
            throw new \Exception("Ocorreu um erro ao editar o livro");
        }
    }

}
