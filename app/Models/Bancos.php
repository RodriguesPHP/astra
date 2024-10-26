<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bancos extends Model
{
    use HasFactory;
    protected $fillable = ['prefix','nome'];

    public function getIDbyPrefix(string $prefix)
    {
        return $this::where('prefix',$prefix)->first()->id;
    }
}
