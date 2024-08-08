<?php

namespace App\DTO;

use App\Http\Requests\StoreAutorRequest;

class CreateLivroDTO
{
    public function __construct(
        public string $titulo,
        public string $editora,
        public string $edicao,
        public string $anoPublicacao,
        public string $autor_codAu,
        public string $assunto_codAs
    )
    {}

    public static function makeFromRequest(StoreAutorRequest $request): self
    {
        return new self(
            $request->titulo,
            $request->editora,
            $request->edicao,
            $request->anoPublicacao,
            $request->autor_codAu,
            $request->assunto_codAs
        );
    }
}
