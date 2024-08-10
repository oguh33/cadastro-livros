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

        <form method="post" action="{{ route('book.store') }}">
            @csrf
            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Título</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           required
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
                           required
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
                           required
                           placeholder="Digite a edição"
                           class="form-control"
                           value="{{ old('edicao') }}"
                           name="edicao" >
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Ano da publicação</label>
                <div class="col-sm-12">
                    <div class="input-group">
                    <input autofocus type="text"
                           required
                           id="datepicker"
                           placeholder="Selecione o ano"
                           class="form-control"
                           value="{{ old('anoPublicacao') }}"
                           name="anoPublicacao" >
                    </div>
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Valor</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           required
                           placeholder="R$ 100,00"
                           onInput="mascaraMoeda(event);"
                           class="form-control"
                           value="{{ old('valor') }}"
                           name="valor" >
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Assunto</label>
                <div class="col-sm-12">
                    <select class="form-control" name="assunto_codAs" required>
                        <option value="" disabled selected>Selecione um assunto</option>
                        @foreach ($subjects as $subject)
                        <option value="{{ $subject->codAs }}" @if(old('assunto_codAs')== $subject->codAs) {{'selected'}} @endif>{{ $subject->descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="autor" class="col-sm-12 col-form-label">Autor</label>
                <div class="col-sm-12">
                    <select class="form-control" name="autor_codAu[]" required id="author-multiple-selected" multiple="multiple">
                        @foreach ($authors as $author)
                            <option value="{{ $author->codAu }}" {{ (collect(old('autor_codAu'))->contains($author->codAu)) ? 'selected':'' }}>{{ $author->nome }}</option>
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
