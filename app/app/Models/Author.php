<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'autor';
    protected $primaryKey = 'codAu';

    protected $fillable = [
        'nome',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'livro_autor', 'autor_codAu', 'livro_codl')
            ->withTimestamps();
    }
}
