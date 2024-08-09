<?php

namespace App\Http\Controllers;

use App\DTO\CreateLivroDTO;
use App\DTO\UpdateLivroDTO;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Services\AssuntoService;
use App\Services\AutorService;
use App\Services\LivroService;

class LivroController extends Controller
{


    public function __construct(
        protected LivroService $service,
    ) { }

    public function index()
    {
        $livros = $this->service->getAll();
        return view('livro/index', compact('livros'));
    }

    public function create(AutorService $autorService, AssuntoService $assuntoService)
    {
        $autores  = $autorService->getAll();
        $assuntos = $assuntoService->getAll();
        return view('livro/create', compact('autores', 'assuntos'));
    }

    public function store(StoreLivroRequest $request)
    {
        $this->service->create(
            CreateLivroDTO::makeFromRequest($request)
        );

        return redirect()->route('livro.index')->with('success', 'Livro cadastrado com sucesso!');
    }

    public function edit(string $id, AutorService $autorService, AssuntoService $assuntoService)
    {
        if ( !$livro = $this->service->findOne($id) ) {
            return redirect()->route('livro.index')->with('error', 'Livro não encontrado!');
        }

        $autores  = $autorService->getAll();
        $assuntos = $assuntoService->getAll();

        return view('livro/edit', compact('livro','autores', 'assuntos'));
    }

    public function update(UpdateLivroRequest $request, string $id)
    {
        $livro = $this->service->update(
            UpdateLivroDTO::makeFromRequest($request, $id)
        );

        if ( !$livro) {
            return redirect()->route('livro.index')->with('error', 'Livro não encontrado ao editar!');
        }

        return redirect()->route('livro.index')->with('success', 'Livro editado com sucesso!');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('livro.index')->with('success', 'Livro removido com sucesso!');
    }
}
