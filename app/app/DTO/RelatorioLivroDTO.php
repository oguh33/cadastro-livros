<?php

namespace App\DTO;

use App\Http\Requests\RelatorioBookRequest;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\StoreBookRequest;

class RelatorioLivroDTO
{
    public function __construct(
        public string|null $titulo,
        public string|null $editora,
        public string|null $edicao,
        public string|null $anoPublicacao,
        public string|null $autores,
        public string|array|null $assuntos
    )
    {}

    public static function makeFromRequest(RelatorioBookRequest $request): self
    {
        return new self(
            $request->titulo,
            $request->editora,
            $request->edicao,
            $request->anoPublicacao,
            $request->autores,
            $request->assuntos
        );
    }
}
