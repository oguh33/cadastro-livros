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
        try {

            $livros = $this->service->getAll();
            return view('livro/index', compact('livros'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

    }

    public function create(AutorService $autorService, AssuntoService $assuntoService)
    {
        try {

            $autores  = $autorService->getAll();
            $assuntos = $assuntoService->getAll();
            return view('livro/create', compact('autores', 'assuntos'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function store(StoreLivroRequest $request)
    {
        try {

            $this->service->create(
                CreateLivroDTO::makeFromRequest($request)
            );

            return redirect()->route('livro.index')->with('success', 'Livro cadastrado com sucesso!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id, AutorService $autorService, AssuntoService $assuntoService)
    {
        try {

            if ( !$livro = $this->service->findOne($id) ) {
                return redirect()->route('livro.index')->with('error', 'Livro não encontrado!');
            }

            $autores  = $autorService->getAll();
            $assuntos = $assuntoService->getAll();

            return view('livro/edit', compact('livro','autores', 'assuntos'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateLivroRequest $request, string $id)
    {
        try {

            $livro = $this->service->update(
                UpdateLivroDTO::makeFromRequest($request, $id)
            );

            if ( !$livro) {
                return redirect()->route('livro.index')->with('error', 'Livro não encontrado ao editar!');
            }

            return redirect()->route('livro.index')->with('success', 'Livro editado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->service->delete($id);

            return redirect()->route('livro.index')->with('success', 'Livro removido com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
