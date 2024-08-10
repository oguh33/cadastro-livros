<?php

namespace App\Repositories;

use App\DTO\RelatorioLivroDTO;
use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class RelatorioVwEloquent implements RelatorioVwRepositoryInterface
{

    public function __construct(
        protected Book $modelLivro
    )
    { }


    public function findBy(RelatorioLivroDTO $dto): Collection|null
    {
        $dbQuery = DB::table('vw_livros');
        if( !is_null($dto->titulo) ) {
            $titulo = $dto->titulo;
            $dbQuery->where(function ($query) use ($titulo) {
                    $query->where('$titulo', 'like', "%$titulo%");
            });
        }

        if( !is_null($dto->editora) ) {
            $editora = $dto->editora;
            $dbQuery->where('editora', 'like', "'%$editora%'");
        }

        if( !is_null($dto->edicao) ) {
            $edicao = $dto->edicao;
            $dbQuery->where('edicao', 'like', "'%$edicao%'");
        }

        if( !is_null($dto->anoPublicacao) ) {
            $dbQuery->where(['anoPublicacao' => $dto->anoPublicacao]);
        }

        if( !is_null($dto->assuntos) ) {
            $dbQuery->whereIn('codAs', $dto->assuntos);
        }

        if( !is_null($dto->autores) ) {
            $dbQuery->where('codAu', $dto->autores);
        }

        $dbQuery->orderby('autor');

        return $dbQuery->get();
    }

}
