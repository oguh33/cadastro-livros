@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center mt-5">
    <div>
        <h1 class="text-center mb-4">Cadastrar livro</h1>

        @if ( $errors->any() )
        <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
        </div>
        @endif

        <form method="post" action="{{ route('livro.store') }}">
            @csrf
            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Título</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           placeholder="Digite o título"
                           class="form-control"
                           value="{{ old('titulo') }}"
                           name="titulo" >
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Editora</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           placeholder="Digite o editora"
                           class="form-control"
                           value="{{ old('editora') }}"
                           name="editora" >
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Edição</label>
                <div class="col-sm-12">
                    <input autofocus type="number"
                           placeholder="Digite a edição"
                           class="form-control"
                           value="{{ old('edicao') }}"
                           name="edicao" >
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Ano da publicação</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           placeholder="Digite a edição"
                           class="form-control"
                           value="{{ old('anoPublicacao') }}"
                           name="anoPublicacao" >
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Valor</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           placeholder="R$ 100,00"
                           class="form-control"
                           value="{{ old('valor') }}"
                           name="valor" >
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Assunto</label>
                <div class="col-sm-12">
                    <select class="form-control" name="autor_codAu" required>
                        <option value="" disabled selected>Selecione um assunto</option>
                        @foreach ($assuntos as $assunto)
                        <option value="{{ $assunto->codAs }}">{{ $assunto->descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="autor" class="col-sm-12 col-form-label">Autor</label>
                <div class="col-sm-12">
                    <select class="form-control" name="autor_codAu" id="autor-multiple-selected" multiple="multiple">
                        @foreach ($autores as $autor)
                            <option value="{{ $autor->codAu }}" >{{ $autor->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-light mr-3" onclick="redirect('/assunto')">Voltar</button>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
    @endsection
