@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center mt-5">
    <div>
        <h1 class="text-center mb-4">Editar livro</h1>


        @if ( $errors->any() )
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif

        <form method="post" action="{{ route('livro.update', $livro->codl) }}">
            @csrf
            <div class="mb-4 d-flex flex-column">
                @method('put')
                <label for="nome" class="col-sm-12 col-form-label">Nome do autor</label>
                <div class="col-sm-12">
                    <input required autofocus type="text" placeholder="Digite a nome do autor" value="{{ $livro->titulo }}" class="form-control" name="titulo">
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Editora</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           required
                           placeholder="Digite o editora"
                           class="form-control"
                           value="{{ $livro->editora }}"
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
                           value="{{ $livro->edicao }}"
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
                               value="{{ $livro->anoPublicacao }}"
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
                           value="{{ $livro->valor }}"
                           name="valor" >
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Assunto</label>
                <div class="col-sm-12">
                    <select class="form-control" name="assunto_codAs" required>
                        @foreach ($assuntos as $assunto)
                        <option value="{{ $assunto->codAs }}" {{ $livro->assuntos->contains($assunto->codAs) ? 'selected' : '' }}>{{ $assunto->descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="autor" class="col-sm-12 col-form-label">Autor</label>
                <div class="col-sm-12">
                    <select class="form-control" name="autor_codAu[]" required id="autor-multiple-selected" multiple="multiple">
                        @foreach ($autores as $autor)
                        <option value="{{ $autor->codAu }}" {{ $livro->autores->contains($autor->codAu) ? 'selected' : '' }}>{{ $autor->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-light mr-3" onclick="redirect('/livro')">Voltar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

    @endsection
