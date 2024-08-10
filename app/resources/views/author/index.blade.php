@extends('layouts.app')
@section('content')

<h1 class="text-center mb-4">Autores</h1>

<div class="d-flex justify-content-end">
    <div class="d-flex">
        <a href="{{ route('author.create') }}" class="btn btn-success mr-2">Cadastrar autor</a>
    </div>
</div>
<div class="mt-4">
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col" class="text-right pr-6">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($authors as $author)
            <tr>
                <td>{{ $author->nome }}</td>
                <td class="text-right">
                    <a href="{{ route('author.edit', $author->codAu) }}"  class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <button type="button" class="btn btn-danger"
                            onclick="_activeModal('{{route('author.destroy', $author->codAu)}}', 'Realmente deseja remover o autor <b>{{ $author->nome }}</b>?')">
                        <i class="bi bi-trash"></i> Excluir
                    </button>
                    @csrf()
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
