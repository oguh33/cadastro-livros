<?php

namespace App\DTO;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;

class UpdateAuthorDTO
{
    public function __construct(
        public string $codAu,
        public string $nome
    )
    {}

    public static function makeFromRequest(UpdateAuthorRequest $request, string $codAu): self
    {
        return new self(
            $codAu,
            $request->nome
        );
    }

}
