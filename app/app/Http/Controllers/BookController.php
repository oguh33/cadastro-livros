<?php

namespace App\Http\Controllers;

use App\DTO\CreateBookDTO;
use App\DTO\UpdateBookDTO;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Services\SubjectService;
use App\Services\AuthorService;
use App\Services\BookService;

class BookController extends Controller
{


    public function __construct(
        protected BookService $service,
    ) { }

    public function index()
    {
        try {

            $books = $this->service->getAll();
            return view('book/index', compact('books'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

    }

    public function create(AuthorService $authorService, SubjectService $subjectService)
    {
        try {

            $authors  = $authorService->getAll();
            $subjects = $subjectService->getAll();
            return view('book/create', compact('authors', 'subjects'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function store(StoreBookRequest $request)
    {
        try {

            $this->service->create(
                CreateBookDTO::makeFromRequest($request)
            );

            return redirect()->route('book.index')->with('success', 'Livro cadastrado com sucesso!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id, AuthorService $authorService, SubjectService $subjectService)
    {
        try {

            if ( !$book = $this->service->findOne($id) ) {
                return redirect()->route('book.index')->with('error', 'Livro não encontrado!');
            }

            $authors  = $authorService->getAll();
            $subjects = $subjectService->getAll();

            return view('book/edit', compact('book','authors', 'subjects'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateBookRequest $request, string $id)
    {
        try {

            $book = $this->service->update(
                UpdateBookDTO::makeFromRequest($request, $id)
            );

            if ( !$book) {
                return redirect()->route('book.index')->with('error', 'Livro não encontrado ao editar!');
            }

            return redirect()->route('book.index')->with('success', 'Livro editado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->service->delete($id);

            return redirect()->route('book.index')->with('success', 'Livro removido com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
