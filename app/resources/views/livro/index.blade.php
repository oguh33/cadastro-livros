@extends('layouts.app')
@section('content')

<h1 class="text-center mb-4">Livros</h1>

<div class="d-flex justify-content-end">
    <div class="d-flex">
        <a href="/cadastrarBaixasAnimaisForm" class="btn btn-success mr-2">Cadastrar livro</a>
    </div>
</div>
<div class="mt-4">
<table class="table">
    <thead>
        <tr>
            <th scope="col">Título</th>
            <th scope="col">Editora</th>
            <th scope="col">Edição</th>
            <th scope="col">Ano Publicação</th>
            <th scope="col">Valor</th>
            <th scope="col" class="text-right pr-6">Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>

        </tr>
    </tbody>
</table>
</div>

@endsection
