<?php

namespace App\DTO;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\StoreBookRequest;

class CreateBookDTO
{
    public function __construct(
        public string $titulo,
        public string $editora,
        public string $edicao,
        public string $anoPublicacao,
        public string $valor,
        public string|array $autor_codAu,
        public string|array $assunto_codAs
    )
    {}

    public static function makeFromRequest(StoreBookRequest $request): self
    {

        return new self(
            $request->titulo,
            $request->editora,
            $request->edicao,
            $request->anoPublicacao,
            self::validMoeda($request->valor),
            $request->autor_codAu,
            $request->assunto_codAs
        );
    }

    public static function validMoeda($valor)
    {
        $valor = str_replace("." , "" , $valor ); // Primeiro tira os pontos
        $valor = str_replace("," , "." , $valor);
        $valor = preg_replace("/[^\d.]/", "", $valor);
        return $valor;
    }
}
