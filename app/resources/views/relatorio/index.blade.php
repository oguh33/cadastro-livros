@extends('layouts.app')
@section('content')

<h1 class="text-center mb-4">Relatórios</h1>

<div class="d-flex justify-content-between">
    <div class="row col-12">
        <div class="col-sm-5">
            <div id="accordion">
                <div class="card mt-3">
                    <div class="card-header cursor-pointer_" id="headingOne" data-toggle="collapse" data-target="#reportQtdNas" aria-expanded="true" aria-controls="reportQtdNas">
                        <div class="btn-link" >
                            Consultar livros
                        </div>
                    </div>
                    <div id="reportQtdNas" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form method="post" action="{{  route('relatorio.livros') }}">
                                @csrf
                                <div class="mb-3 d-flex flex-column">
                                    <label for="nome" class="col-sm-12 col-form-label">Título</label>
                                    <div class="col-sm-12">
                                        <input autofocus type="text"
                                               placeholder="Nome do livro"
                                               class="form-control"
                                               name="titulo" >
                                    </div>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="nome" class="col-sm-12 col-form-label">Editora</label>
                                    <div class="col-sm-12">
                                        <input autofocus type="text"
                                               placeholder="Nome da editora"
                                               class="form-control"
                                               name="editora" >
                                    </div>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="nome" class="col-sm-12 col-form-label">Edição</label>
                                    <div class="col-sm-12">
                                        <input autofocus type="number"
                                               placeholder="Número da edição"
                                               class="form-control"
                                               name="edicao" >
                                    </div>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="nome" class="col-sm-12 col-form-label">Ano da publicação</label>
                                    <div class="col-sm-12">
                                        <input autofocus type="text"
                                               id="datepicker"
                                               placeholder="Selecione o ano"
                                               class="form-control"
                                               name="anoPublicacao" >
                                    </div>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="nome" class="col-sm-12 col-form-label">Assunto</label>
                                    <div class="col-sm-12">
                                        <select class="form-control w-100" name="assuntos[]" id="assunto-multiple-selected" multiple="multiple">
                                            @foreach ($assuntos as $assunto)
                                            <option value="{{ $assunto->codAs }}">{{ $assunto->descricao }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="nome" class="col-sm-12 col-form-label">Autor</label>
                                    <div class="col-sm-12">
                                        <select class="form-control w-100" name="autores" id="rel-autor-multiple-selected">
                                            <option value="">Todos os autores</option>
                                            @foreach ($autores as $autor)
                                            <option value="{{ $autor->codAu }}">{{ $autor->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Gerar relatório</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
