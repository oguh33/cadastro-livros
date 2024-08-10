@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center mt-5">
    <div>
        <h1 class="text-center mb-4">Cadastrar autor</h1>

        @if ( $errors->any() )
        <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
        </div>
        @endif

        <form method="post" action="{{ route('author.store') }}">
            @csrf
            <div class="mb-3 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Nome do autor</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           placeholder="Digite a nome do autor"
                           class="form-control"
                           value="{{ old('nome') }}"
                           name="nome" >
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-light mr-3" onclick="redirect('/author')">Voltar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>

    @endsection
