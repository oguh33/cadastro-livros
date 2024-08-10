<?php

namespace App\DTO;

use App\Http\Requests\StoreAuthorRequest;

class CreateAuthorDTO
{
    public function __construct(
        public string $nome
    )
    {}

    public static function makeFromRequest(StoreAuthorRequest $request): self
    {
        return new self(
            $request->nome
        );
    }
}
