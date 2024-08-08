<?php

namespace App\Http\Controllers;

use App\DTO\CreateAutorDTO;
use App\DTO\UpdateAutorDTO;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Http\Request;

class AutorController extends Controller
{

    public function __construct(
        protected AutorService $service
    ) {}

    public function index(Request $request)
    {
        $autores = $this->service->getAll($request->filter);

        return view('autor/index', compact('autores'));
    }

    public function create()
    {
        return view('autor/create');
    }

    public function store(StoreAutorRequest $request)
    {
       $this->service->create(
           CreateAutorDTO::makeFromRequest($request)
       );

       return redirect()->route('autor.index')->with('success', 'Autor cadastrado com sucesso!');
    }

    public function edit(string $id)
    {
        if ( !$autor = $this->service->findOne($id) ) {
            return redirect()->route('autor.index')->with('error', 'Autor não encontrado!');
        }

        return view('autor/edit', compact('autor'));
    }

    public function update(UpdateAutorRequest $request, string $id)
    {
        $autor = $this->service->update(
            UpdateAutorDTO::makeFromRequest($request, $id)
        );

        if ( !$autor) {
            return redirect()->route('autor.index')->with('error', 'Autor não encontrado ao editar!');
        }

        return redirect()->route('autor.index')->with('success', 'Autor editado com sucesso!');
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);

        return redirect()->route('autor.index')->with('success', 'Autor removido com sucesso!');
    }
}
