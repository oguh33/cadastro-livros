@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center mt-5">
    <div>
        <h1 class="text-center mb-4">Editar assunto</h1>


        @if ( $errors->any() )
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif

        <form method="post" action="{{ route('assunto.update', $assunto->codAs) }}">
            @csrf
            <div class="mb-3 d-flex flex-column">
                @method('put')
                <label for="nome" class="col-sm-12 col-form-label">Descrição do assunto</label>
                <div class="col-sm-12">
                    <input required autofocus type="text" value="{{ $assunto->descricao }}" class="form-control" name="descricao">
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-light mr-3" onclick="redirect('/assunto')">Voltar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

    @endsection
