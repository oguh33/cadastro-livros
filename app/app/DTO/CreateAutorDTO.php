<?php

namespace App\DTO;

use App\Http\Requests\StoreAutorRequest;

class CreateAutorDTO
{
    public function __construct(
        public string $nome
    )
    {}

    public static function makeFromRequest(StoreAutorRequest $request): self
    {
        return new self(
            $request->nome
        );
    }
}
