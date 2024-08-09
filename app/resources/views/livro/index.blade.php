@extends('layouts.app')
@section('content')

<h1 class="text-center mb-4">Livros</h1>

<div class="d-flex justify-content-end">
    <div class="d-flex">
        <a href="{{ route('livro.create') }}"
           class="btn btn-success mr-2" >Cadastrar livro</a>
    </div>
</div>
<div class="mt-4">
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Título</th>
            <th scope="col">Editora</th>
            <th scope="col">Edição</th>
            <th scope="col">Ano Publicação</th>
            <th scope="col">Valor</th>
            <th scope="col">Assunto</th>
            <th scope="col">Autor(es)</th>
            <th scope="col" class="text-right pr-6">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($livros as $livro)
            <tr>
                <td>{{ $livro->titulo }}</td>
                <td>{{ $livro->editora }}</td>
                <td>{{ $livro->edicao }}</td>
                <td>{{ $livro->anoPublicacao }}</td>
                <td>{{ $livro->valor }}</td>
                <td>
                    @foreach($livro->assuntos as $assunto)
                     <span> {{ $assunto->descricao }} </span> <br/>
                    @endforeach
                </td>
                <td>
                    @foreach($livro->autores as $autor)
                    <li> {{ $autor->nome }} </li>
                    @endforeach
                </td>
                <td class="text-right">
                    <a href="{{ route('livro.edit', $livro->codl) }}"  class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <button type="button" class="btn btn-danger"
                            onclick="_activeModal('{{route('livro.destroy', $livro->codl)}}', 'Realmente deseja remover o livro <b>{{ $livro->titulo }}</b>?')">
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
