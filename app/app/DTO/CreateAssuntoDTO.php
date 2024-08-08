<?php

namespace App\DTO;

use App\Http\Requests\StoreAssuntoRequest;

class CreateAssuntoDTO
{
    public function __construct(
        public string $descricao
    )
    {}

    public static function makeFromRequest(StoreAssuntoRequest $request): self
    {
        return new self(
            $request->descricao
        );
    }
}
