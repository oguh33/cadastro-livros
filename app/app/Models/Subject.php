<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'assunto';
    protected $primaryKey = 'codAs';

    protected $fillable = [
        'descricao',
    ];

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_assunto', 'assunto_codAs', 'livro_codl')
            ->withTimestamps();
    }
}
