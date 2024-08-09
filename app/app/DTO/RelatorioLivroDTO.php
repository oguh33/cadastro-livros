<?php

namespace App\DTO;

use App\Http\Requests\RelatorioLivroRequest;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\StoreLivroRequest;

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

    public static function makeFromRequest(RelatorioLivroRequest $request): self
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
