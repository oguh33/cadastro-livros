<?php

namespace App\Http\Controllers;

use App\DTO\RelatorioLivroDTO;
use App\Http\Requests\RelatorioBookRequest;
use App\Services\SubjectService;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Services\RelatorioService;

class RelatorioController extends Controller
{
    public function index(AuthorService $autorService, SubjectService $assuntoService)
    {
        $autores  = $autorService->getAll();
        $assuntos = $assuntoService->getAll();

        return view('relatorio/index', compact('autores', 'assuntos'));
    }

    public function livros(RelatorioBookRequest $request, RelatorioService $service)
    {
        $results = $service->findBy(
            RelatorioLivroDTO::makeFromRequest($request)
        );

        return view('relatorio/livros', compact('results'));
    }
}
