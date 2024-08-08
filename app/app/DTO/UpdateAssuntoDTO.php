<?php

namespace App\DTO;

use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAssuntoRequest;
use App\Http\Requests\UpdateAutorRequest;

class UpdateAssuntoDTO
{
    public function __construct(
        public string $codAs,
        public string $descricao
    )
    {}

    public static function makeFromRequest(UpdateAssuntoRequest $request, string $codAs): self
    {
        return new self(
            $codAs,
            $request->descricao
        );
    }

}
