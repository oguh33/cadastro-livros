<?php

namespace App\Http\Controllers;

use App\DTO\CreateAutorDTO;
use App\DTO\UpdateAutorDTO;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Services\AutorService;
use Illuminate\Http\Request;
use \Exception;

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
        try {

            $this->service->create(
                CreateAutorDTO::makeFromRequest($request)
            );

            return redirect()->route('autor.index')->with('success', 'Autor cadastrado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {

            if ( !$autor = $this->service->findOne($id) ) {
                return redirect()->route('autor.index')->with('error', 'Autor não encontrado!');
            }

            return view('autor/edit', compact('autor'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateAutorRequest $request, string $id)
    {
        try {

            $autor = $this->service->update(
                UpdateAutorDTO::makeFromRequest($request, $id)
            );

            if ( !$autor) {
                return redirect()->route('autor.index')->with('error', 'Autor não encontrado ao editar!');
            }

            return redirect()->route('autor.index')->with('success', 'Autor editado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->service->delete($id);

            return redirect()->route('autor.index')->with('success', 'Autor removido com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
