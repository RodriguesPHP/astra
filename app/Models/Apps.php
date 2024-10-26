<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apps extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'banco_id',
        'produto',
        'nome',
        'usuario',
        'senha',
        'client_id',
        'secret_id',
        'cpfagente',
        'usuariodigitador'
    ];
}
