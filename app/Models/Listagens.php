<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listagens extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'banco_id',
        'tipo',
        'nome',
        'sit',
        'registros'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function banco(){
        return $this->belongsTo(Bancos::class, 'banco_id');
    }
    public function produto(){
        return $this->belongsTo(Produtos::class, 'tipo','prefix');
    }
}
