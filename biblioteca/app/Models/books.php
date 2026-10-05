<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    protected $fillable = [
        'titulo',
        'autor',
        'ano_publicacao',
        'editora',
        'genero',
        'quantidade_disponivel',
    ];
}
