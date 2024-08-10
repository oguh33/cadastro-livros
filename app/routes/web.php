<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RelatorioController;

Route::get('/', [BookController::class, 'index']);

Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');
Route::put('/book/{id}', [BookController::class, 'update'])->name('book.update');
Route::get('/book/create', [BookController::class, 'create'])->name('book.create');
Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::post('/book', [BookController::class, 'store'])->name('book.store');


Route::delete('/subject/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');
Route::put('/subject/{id}', [SubjectController::class, 'update'])->name('subject.update');
Route::get('/subject/create', [SubjectController::class, 'create'])->name('subject.create');
Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
Route::get('/subject/{id}/edit', [SubjectController::class, 'edit'])->name('subject.edit');
Route::post('/subject', [SubjectController::class, 'store'])->name('subject.store');

Route::delete('/author/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');
Route::put('/author/{id}', [AuthorController::class, 'update'])->name('author.update');
Route::get('/author/{id}/edit', [AuthorController::class, 'edit'])->name('author.edit');
Route::get('/author/create', [AuthorController::class, 'create'])->name('author.create');
Route::get('/author', [AuthorController::class, 'index'])->name('author.index');
Route::post('/author', [AuthorController::class, 'store'])->name('author.store');

Route::get('/relatorio', [RelatorioController::class, 'index'])->name('relatorio.index');
Route::post('/relatorio/livros', [RelatorioController::class, 'livros'])->name('relatorio.livros');
