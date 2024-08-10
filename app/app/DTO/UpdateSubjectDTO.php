<?php

namespace App\DTO;

use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Requests\UpdateAutorRequest;

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
