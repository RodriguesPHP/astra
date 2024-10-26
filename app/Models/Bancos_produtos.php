<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bancos_produtos extends Model
{
    use HasFactory;

    protected $table = 'bancos_produtos';


    public function produtos(){
        return $this->hasMany(Produtos::class,'id');
    }

    public function produto(){
        return $this->belongsTo(Produtos::class,'produto_id');
    }

    public function bancos()
    {
        return $this->belongsTo(Bancos::class,'banco_id','id');
    }
}
