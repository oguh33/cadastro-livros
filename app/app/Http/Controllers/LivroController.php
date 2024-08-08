<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function index(Livro $livro)
    {
        $livros = $livro->all();
        return view('livro/index');

    }
}
