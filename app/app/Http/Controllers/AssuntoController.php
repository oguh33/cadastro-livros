<?php

namespace App\Http\Controllers;

use App\DTO\CreateAssuntoDTO;
use App\DTO\UpdateAssuntoDTO;
use App\Http\Requests\StoreAssuntoRequest;
use App\Http\Requests\UpdateAssuntoRequest;
use App\Services\AssuntoService;
use Illuminate\Http\Request;
use \Exception;

class AssuntoController extends Controller
{
    public function __construct(
        protected AssuntoService $service
    ) {}

    public function index(Request $request)
    {
        try {
            $assuntos = $this->service->getAll($request->filter);

            return view('assunto/index', compact('assuntos'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('assunto/create');
    }

    public function store(StoreAssuntoRequest $request)
    {
        try {

            $this->service->create(
                CreateAssuntoDTO::makeFromRequest($request)
            );

            return redirect()->route('assunto.index')->with('success', 'Assunto cadastrado com sucesso!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {

            if ( !$assunto = $this->service->findOne($id) ) {
                return redirect()->route('assunto.index')->with('error', 'Assunto não encontrado!');
            }

            return view('assunto/edit', compact('assunto'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateAssuntoRequest $request, string $id)
    {
        try {

            $assunto = $this->service->update(
                UpdateAssuntoDTO::makeFromRequest($request, $id)
            );

            if ( !$assunto) {
                return redirect()->route('assunto.index')->with('error', 'Assunto não encontrado ao editar!');
            }

            return redirect()->route('assunto.index')->with('success', 'Assunto editado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->service->delete($id);

            return redirect()->route('assunto.index')->with('success', 'Assunto removido com sucesso!');

        }catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

    }
}
