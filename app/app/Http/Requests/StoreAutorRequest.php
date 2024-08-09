<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAutorRequest extends FormRequest
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
            'nome' => 'required|min:3|max:40|unique:autor'
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do Autor é obrigatório',
            'nome.min' => 'O nome do Autor deve ter no mínimo 3 caracteres',
            'nome.max' => 'O nome do Autor deve ter no máximo 40 caracteres',
            'nome.unique' => 'O nome do Autor já foi cadastrado',
        ];
    }
}
