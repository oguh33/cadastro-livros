<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\RelatorioController;

Route::get('/', [LivroController::class, 'index']);

Route::delete('/livro/{id}', [LivroController::class, 'destroy'])->name('livro.destroy');
Route::put('/livro/{id}', [LivroController::class, 'update'])->name('livro.update');
Route::get('/livro/create', [LivroController::class, 'create'])->name('livro.create');
Route::get('/livro', [LivroController::class, 'index'])->name('livro.index');
Route::get('/livro/{id}/edit', [LivroController::class, 'edit'])->name('livro.edit');
Route::post('/livro', [LivroController::class, 'store'])->name('livro.store');


Route::delete('/subject/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');
Route::put('/subject/{id}', [SubjectController::class, 'update'])->name('subject.update');
Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
Route::get('/subject/{id}/edit', [SubjectController::class, 'edit'])->name('subject.edit');
Route::post('/subject', [SubjectController::class, 'store'])->name('subject.store');

Route::delete('/autor/{id}', [AutorController::class, 'destroy'])->name('autor.destroy');
Route::put('/autor/{id}', [AutorController::class, 'update'])->name('autor.update');
Route::get('/autor/{id}/edit', [AutorController::class, 'edit'])->name('autor.edit');
Route::get('/autor/create', [AutorController::class, 'create'])->name('autor.create');
Route::get('/autor', [AutorController::class, 'index'])->name('autor.index');
Route::post('/autor', [AutorController::class, 'store'])->name('autor.store');

Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
Route::post('/relatorio/livros', [RelatorioController::class, 'livros'])->name('relatorio.livros');
