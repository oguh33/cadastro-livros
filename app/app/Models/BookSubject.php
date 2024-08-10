<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookSubject extends Pivot
{
    protected $table = 'livro_assunto';
    public $timestamps = true;
}
