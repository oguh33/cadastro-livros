<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssuntoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'descricao' => [
                'required',
                'min:2',
                'max:20',
                "unique:assunto,descricao,{$this->id},codAs"
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'descricao.required' => 'A descrição do assunto é obrigatória',
            'descricao.min'      => 'A descrição do assunto deve ter no mínimo 3 caracteres',
            'descricao.max'      => 'A descrição do assunto deve ter no máximo 20 caracteres',
            'descricao.unique'   => 'A nome do assunto já foi cadastrado',
        ];
    }
}
