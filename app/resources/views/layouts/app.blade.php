<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <title>Desafio Teste Técnico - PHP</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<!--    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>-->
<!--    <script src="{{ asset('js/jquery.min.js') }}"></script>-->
<!--    <script src="{{ asset('js/jquery.js') }}"></script>-->
<!--    <script src="{{ asset('js/bootstrap.js') }}"></script>-->
<!--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}" type="text/css"/>
    <script src="{{ asset('js/scripts.js') }}"></script>
</head>


<body class="font-sans antialiased">
    @include('layouts.navigation')

    <!-- Mensagem de sucesso -->
    @if(session('success'))
    <div class="alert alert-success mt-2 w-100 text-center">
        {{ session('success') }}
    </div>
    @endif

    <!-- Mensagem de erro -->
    @if(session('error'))
    <div class="alert alert-danger mt-2 w-100 text-center">
        {{ session('error') }}
    </div>
    @endif

    <div class="d-flex justify-content-center align-items-center" style="padding: 30px;"> <!-- Altura da viewport -->
        <div class="card pt-5 pb-5 p-2" style="width: 100%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            @yield('content')
        </div>
    </div>

    <!--   MODAL EXCLUIR  -->
    <div class="modal fade" id="excluir_remover" tabindex="-1" role="dialog" aria-labelledby="excluir_remover" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Excluir</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center" id="remover_">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <div id="btn-remove">
                        <button type="submit" class="btn btn-primary">Excluir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
