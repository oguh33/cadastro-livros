<?php

namespace App\DTO;

use App\Http\Requests\StoreSubjectRequest;

class CreateSubjectDTO
{
    public function __construct(
        public string $descricao
    )
    {}

    public static function makeFromRequest(StoreSubjectRequest $request): self
    {
        return new self(
            $request->descricao
        );
    }
}
