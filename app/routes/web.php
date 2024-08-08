<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\RelatorioController;

Route::get('/', [LivroController::class, 'index']);
Route::get('/livro', [LivroController::class, 'index'])->name('livro.index');
Route::get('/assunto', [AssuntoController::class, 'index'])->name('assunto.index');

Route::delete('/autor/{id}', [AutorController::class, 'destroy'])->name('autor.destroy');
Route::put('/autor/{id}', [AutorController::class, 'update'])->name('autor.update');
Route::get('/autor/{id}/edit', [AutorController::class, 'edit'])->name('autor.edit');
Route::get('/autor/create', [AutorController::class, 'create'])->name('autor.create');
Route::get('/autor', [AutorController::class, 'index'])->name('autor.index');
Route::post('/autor', [AutorController::class, 'store'])->name('autor.store');

Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
