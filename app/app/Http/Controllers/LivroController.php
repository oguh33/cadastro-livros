<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use App\Models\Livro;
use App\Services\AssuntoService;
use App\Services\AutorService;
use App\Services\LivroService;
use Illuminate\Http\Request;

class LivroController extends Controller
{


    public function __construct(
        protected LivroService $livroService,
    ) { }

    public function index()
    {
        $livros = [];
        return view('livro/index', compact('livros'));
    }

    public function create(AutorService $autorService, AssuntoService $assuntoService)
    {
        $autores  = $autorService->getAll();
        $assuntos = $assuntoService->getAll();
        return view('livro/create', compact('autores', 'assuntos'));
    }

    public function store(Request $request)
    {
        dd('aqui ');
    }
}
