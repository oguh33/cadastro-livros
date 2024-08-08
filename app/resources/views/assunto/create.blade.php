@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center mt-5">
    <div>
        <h1 class="text-center mb-4">Cadastrar assunto</h1>

        @if ( $errors->any() )
        <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
        </div>
        @endif

        <form method="post" action="{{ route('assunto.store') }}">
            @csrf
            <div class="mb-3 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Descrição do assunto</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           placeholder="Digite breve descrição do assunto"
                           class="form-control"
                           value="{{ old('descricao') }}"
                           name="descricao" >
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-light mr-3" onclick="redirect('/assunto')">Voltar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>

    @endsection
