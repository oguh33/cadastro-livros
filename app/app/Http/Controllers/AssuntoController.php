<?php

namespace App\Http\Controllers;

use App\DTO\CreateAssuntoDTO;
use App\DTO\UpdateAssuntoDTO;
use App\Http\Requests\StoreAssuntoRequest;
use App\Http\Requests\UpdateAssuntoRequest;
use App\Services\AssuntoService;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    public function __construct(
        protected AssuntoService $service
    ) {}

    public function index(Request $request)
    {
        $assuntos = $this->service->getAll($request->filter);

        return view('assunto/index', compact('assuntos'));
    }

    public function create()
    {
        return view('assunto/create');
    }

    public function store(StoreAssuntoRequest $request)
    {
        $this->service->create(
            CreateAssuntoDTO::makeFromRequest($request)
        );

        return redirect()->route('assunto.index')->with('success', 'Assunto cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        if ( !$assunto = $this->service->findOne($id) ) {
            return redirect()->route('assunto.index')->with('error', 'Assunto não encontrado!');
        }

        return view('assunto/edit', compact('assunto'));
    }

    public function update(UpdateAssuntoRequest $request, string $id)
    {
        $assunto = $this->service->update(
            UpdateAssuntoDTO::makeFromRequest($request, $id)
        );

        if ( !$assunto) {
            return redirect()->route('assunto.index')->with('error', 'Assunto não encontrado ao editar!');
        }

        return redirect()->route('assunto.index')->with('success', 'Assunto editado com sucesso!');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('assunto.index')->with('success', 'Assunto removido com sucesso!');
    }
}
