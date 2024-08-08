<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\RelatorioController;

Route::get('/', [LivroController::class, 'index']);

Route::delete('/livro/{id}', [LivroController::class, 'destroy'])->name('livro.destroy');
Route::put('/livro/{id}', [LivroController::class, 'update'])->name('livro.update');
Route::get('/livro/create', [LivroController::class, 'create'])->name('livro.create');
Route::get('/livro', [LivroController::class, 'index'])->name('livro.index');
Route::get('/livro/{id}/edit', [LivroController::class, 'edit'])->name('livro.edit');
Route::post('/livro', [LivroController::class, 'store'])->name('livro.store');


Route::delete('/assunto/{id}', [AssuntoController::class, 'destroy'])->name('assunto.destroy');
Route::put('/assunto/{id}', [AssuntoController::class, 'update'])->name('assunto.update');
Route::get('/assunto/create', [AssuntoController::class, 'create'])->name('assunto.create');
Route::get('/assunto', [AssuntoController::class, 'index'])->name('assunto.index');
Route::get('/assunto/{id}/edit', [AssuntoController::class, 'edit'])->name('assunto.edit');
Route::post('/assunto', [AssuntoController::class, 'store'])->name('assunto.store');

Route::delete('/autor/{id}', [AutorController::class, 'destroy'])->name('autor.destroy');
Route::put('/autor/{id}', [AutorController::class, 'update'])->name('autor.update');
Route::get('/autor/{id}/edit', [AutorController::class, 'edit'])->name('autor.edit');
Route::get('/autor/create', [AutorController::class, 'create'])->name('autor.create');
Route::get('/autor', [AutorController::class, 'index'])->name('autor.index');
Route::post('/autor', [AutorController::class, 'store'])->name('autor.store');

Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
