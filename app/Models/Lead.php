<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf',
        'nome',
        'telefone',
        'banco',
        'saldo',
        'saldo_lib',
    ];
}
