<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use App\Models\Bancos_produtos;
use App\Models\Produtos;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function produtos_index(){
        $bancos = Bancos::all();
        $produtos = Produtos::all();
        $bancos_produtos = Bancos_produtos::with(['produto','bancos'])->get();
        return view('admin.produtos', compact('bancos', 'produtos', 'bancos_produtos'));
    }
}
