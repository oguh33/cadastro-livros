<?php

namespace App\DTO;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Requests\UpdateAuthorRequest;

class UpdateSubjectDTO
{
    public function __construct(
        public string $codAs,
        public string $descricao
    )
    {}

    public static function makeFromRequest(UpdateSubjectRequest $request, string $codAs): self
    {
        return new self(
            $codAs,
            $request->descricao
        );
    }

}
