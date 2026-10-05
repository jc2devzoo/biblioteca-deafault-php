<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loans extends Model
{
    public $fillable = [
        'id_user',
        'id_book',
        'data_emprestimo',
        'data_devolucao',
        'n_renovacoes',
    ];
}
