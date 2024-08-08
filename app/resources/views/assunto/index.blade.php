@extends('layouts.app')
@section('content')

<h1 class="text-center mb-4">Assuntos</h1>

<div class="d-flex justify-content-end">
    <div class="d-flex">
        <a href="/cadastrarBaixasAnimaisForm" class="btn btn-primary mr-2">Cadastrar assunto</a>
    </div>
</div>
<div class="mt-4">
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
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
