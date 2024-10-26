<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    use HasFactory;

    protected $fillable = [
        'saldo',
        'saldo_lib',
        'sit',
        'parcelas',
        'idsimulacao',
        'log'
    ];

    public function bancos()
    {
        return $this->belongsTo(Bancos::class,'banco_id','id');
    }
}
