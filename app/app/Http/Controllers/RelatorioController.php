<?php

namespace App\Http\Controllers;

use App\DTO\RelatorioLivroDTO;
use App\Http\Requests\RelatorioLivroRequest;
use App\Services\AssuntoService;
use App\Services\AutorService;
use App\Services\LivroService;
use App\Services\RelatorioService;

class RelatorioController extends Controller
{
    public function index(AutorService $autorService, AssuntoService $assuntoService)
    {
        $autores  = $autorService->getAll();
        $assuntos = $assuntoService->getAll();

        return view('relatorio/index', compact('autores', 'assuntos'));
    }

    public function livros(RelatorioLivroRequest $request, RelatorioService $service)
    {
        $results = $service->findBy(
            RelatorioLivroDTO::makeFromRequest($request)
        );

        return view('relatorio/livros', compact('results'));
    }
}
