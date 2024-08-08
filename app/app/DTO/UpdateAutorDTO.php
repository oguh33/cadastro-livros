<?php

namespace App\DTO;

use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;

class UpdateAutorDTO
{
    public function __construct(
        public string $codAu,
        public string $nome
    )
    {}

    public static function makeFromRequest(UpdateAutorRequest $request, string $codAu): self
    {
        return new self(
            $codAu,
            $request->nome
        );
    }

}
