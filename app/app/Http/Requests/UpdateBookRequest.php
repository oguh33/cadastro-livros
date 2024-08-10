<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'titulo' => 'required|min:2|max:40',
            'editora' => 'required|min:2|max:40',
            'edicao' => 'required|numeric',
            'anoPublicacao' => 'required|min:4|max:4',
            'valor' => 'required',
            'autor_codAu' => 'required',
            'assunto_codAs' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O campo título é obrigatório',
            'titulo.min' => 'O campo título deve ter no mínimo 2 caracteres',
            'titulo.max' => 'O campo título deve ter no máximo 40 caracteres',
            'editora.required' => 'O campo editora é obrigatório',
            'editora.min' => 'O campo editora deve ter no mínimo 2 caracteres',
            'editora.max' => 'O campo editora deve ter no máximo 40 caracteres',
            'anoPublicacao.required' => 'O ano da publicação é obrigatório',
            'anoPublicacao.min' => 'O ano da publicação deve ter 4 caracteres',
            'anoPublicacao.max' => 'O ano da publicação deve ter 4 caracteres',
            'valor.required' => 'O campo valor é obrigatório',
            'autor_codAu.required' => 'Selecionar um autor é obrigatório',
            'assunto_codAs.required' => 'Selecionar um asssunto é obrigatório',
        ];
    }
}
