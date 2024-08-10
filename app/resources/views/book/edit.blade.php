@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center mt-5">
    <div>
        <h1 class="text-center mb-4">Editar livro</h1>


        @if ( $errors->any() )
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="post" action="{{ route('book.update', $book->codl) }}">
            @csrf
            <div class="mb-4 d-flex flex-column">
                @method('put')
                <label for="nome" class="col-sm-12 col-form-label">Nome do autor</label>
                <div class="col-sm-12">
                    <input required autofocus type="text" placeholder="Digite a nome do autor" value="{{ $book->titulo }}" class="form-control" name="titulo">
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Editora</label>
                <div class="col-sm-12">
                    <input autofocus type="text"
                           required
                           placeholder="Digite o editora"
                           class="form-control"
                           value="{{ $book->editora }}"
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
                           value="{{ $book->edicao }}"
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
                               value="{{ $book->anoPublicacao }}"
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
                           value="{{ $book->valor }}"
                           name="valor" >
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="nome" class="col-sm-12 col-form-label">Assunto</label>
                <div class="col-sm-12">
                    <select class="form-control" name="assunto_codAs" required>
                        @foreach ($subjects as $subject)
                        <option value="{{ $subject->codAs }}" {{ $book->subjects->contains($subject->codAs) ? 'selected' : '' }}>{{ $subject->descricao }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="autor" class="col-sm-12 col-form-label">Autor</label>
                <div class="col-sm-12">
                    <select class="form-control" name="autor_codAu[]" required id="author-multiple-selected" multiple="multiple">
                        @foreach ($authors as $author)
                        <option value="{{ $author->codAu }}" {{ $book->authors->contains($author->codAu) ? 'selected' : '' }}>{{ $author->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-light mr-3" onclick="redirect('/book')">Voltar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

    @endsection
