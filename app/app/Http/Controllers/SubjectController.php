<?php

namespace App\Http\Controllers;

use App\DTO\CreateSubjectDTO;
use App\DTO\UpdateSubjectDTO;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Services\SubjectService;
use Illuminate\Http\Request;
use \Exception;

class SubjectController extends Controller
{
    public function __construct(
        protected SubjectService $service
    ) {}

    public function index(Request $request)
    {
        try {
            $subjects = $this->service->getAll($request->filter);

            return view('subject/index', compact('subjects'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        return view('subject/create');
    }

    public function store(StoreSubjectRequest $request)
    {
        try {

            $this->service->create(
                CreateSubjectDTO::makeFromRequest($request)
            );

            return redirect()->route('subject.index')->with('success', 'Assunto cadastrado com sucesso!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {

            if ( !$subject = $this->service->findOne($id) ) {
                return redirect()->route('subject.index')->with('error', 'Assunto não encontrado!');
            }

            return view('subject/edit', compact('subject'));

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function update(UpdateSubjectRequest $request, string $id)
    {
        try {

            $subject = $this->service->update(
                UpdateSubjectDTO::makeFromRequest($request, $id)
            );

            if ( !$subject) {
                return redirect()->route('subject.index')->with('error', 'Assunto não encontrado ao editar!');
            }

            return redirect()->route('subject.index')->with('success', 'Assunto editado com sucesso!');

        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->service->delete($id);

            return redirect()->route('subject.index')->with('success', 'Assunto removido com sucesso!');

        }catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

    }
}
