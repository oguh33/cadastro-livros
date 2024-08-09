@extends('layouts.app')
@section('content')

<h1 class="text-center mb-4">Relatório de livros</h1>

<div class="mt-4">
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Autor</th>
            <th scope="col">Título</th>
            <th scope="col">Editora</th>
            <th scope="col">Edição</th>
            <th scope="col">Ano Publicação</th>
            <th scope="col">Valor</th>
            <th scope="col">Assunto</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $livro)
            <tr>
                <td>{{ $livro->autor }}</td>
                <td>{{ $livro->titulo }}</td>
                <td>{{ $livro->editora }}</td>
                <td>{{ $livro->edicao }}</td>
                <td>{{ $livro->anoPublicacao }}</td>
                <td>R$ {{ number_format((float) $livro->valor, 2, ',', '.') }}</td>
                <td>{{ $livro->assunto }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
<div class="text-center">
    <button type="button" class="btn btn-light mr-3" onclick="redirect('/relatorio')">Voltar</button>
</div>

@endsection
