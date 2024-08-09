<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LivroAssunto extends Pivot
{
    protected $table = 'livro_assunto';
    public $timestamps = true;
}
