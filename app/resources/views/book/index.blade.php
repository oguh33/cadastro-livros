@extends('layouts.app')
@section('content')

<h1 class="text-center mb-4">Livros</h1>

<div class="d-flex justify-content-end">
    <div class="d-flex">
        <a href="{{ route('book.create') }}"
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
        @foreach($books as $book)
            <tr>
                <td>{{ $book->titulo }}</td>
                <td>{{ $book->editora }}</td>
                <td>{{ $book->edicao }}</td>
                <td>{{ $book->anoPublicacao }}</td>
                <td>{{ $book->valor }}</td>
                <td>
                    @foreach($book->subjects as $subjects)
                     <span> {{ $subjects->descricao }} </span> <br/>
                    @endforeach
                </td>
                <td>
                    @foreach($book->authors as $author)
                    <li> {{ $author->nome }} </li>
                    @endforeach
                </td>
                <td class="text-right">
                    <a href="{{ route('book.edit', $book->codl) }}"  class="btn btn-primary">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <button type="button" class="btn btn-danger"
                            onclick="_activeModal('{{route('book.destroy', $book->codl)}}', 'Realmente deseja remover o livro <b>{{ $book->titulo }}</b>?')">
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
