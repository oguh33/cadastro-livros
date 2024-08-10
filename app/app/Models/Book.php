<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'livro';
    protected $primaryKey = 'codl';

    protected $fillable = [
        'titulo',
        'editora',
        'edicao',
        'anoPublicacao',
        'valor',
    ];

    public function getValorAttribute($value)
    {
        return 'R$ ' . number_format((float) $value, 2, ',', '.');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'livro_autor', 'livro_codl', 'autor_codAu')
            ->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'livro_assunto', 'livro_codl', 'assunto_codAs')
            ->withTimestamps();
    }
}
