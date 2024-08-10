<?php

namespace App\Http\Controllers;

use App\DTO\CreateAuthorDTO;
use App\DTO\UpdateAuthorDTO;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Services\AuthorService;
use Illuminate\Http\Request;
use \Exception;

class AuthorController extends Controller
{

    public function __construct(
        protected AuthorService $service
    ) {}

    public function index(Request $request)
    {
        $authors = $this->service->getAll($request->filter);

        return view('author/index', compact('authors'));
    }

    public function create()
    {
        return view('author/create');
    }

    public function store(StoreAuthorRequest $request)
    {
        try {

            $this->service->create(
                CreateAuthorDTO::makeFromRequest($request)
            );

            return redirect()->route('author.index')->with('success', 'Autor cadastrado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {

            if ( !$author = $this->service->findOne($id) ) {
                return redirect()->route('author.index')->with('error', 'Autor não encontrado!');
            }

            return view('author/edit', compact('author'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateAuthorRequest $request, string $id)
    {
        try {

            $author = $this->service->update(
                UpdateAuthorDTO::makeFromRequest($request, $id)
            );

            if ( !$author) {
                return redirect()->route('author.index')->with('error', 'Autor não encontrado ao editar!');
            }

            return redirect()->route('author.index')->with('success', 'Autor editado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->service->delete($id);

            return redirect()->route('author.index')->with('success', 'Autor removido com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
