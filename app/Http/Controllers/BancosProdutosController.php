<?php

namespace App\Http\Controllers;

use App\Models\Bancos_produtos;
use Illuminate\Http\Request;

class BancosProdutosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $banco_produto = new Bancos_produtos;

        $banco_produto->banco_id = $request->banco;
        $banco_produto->produto_id = $request->produto;

        $banco_produto->save();

        if($banco_produto){
            return redirect()->back()->with('success', 'Produto listado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possivel listar o produto!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bancos_produtos $bancos_produtos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bancos_produtos $bancos_produtos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bancos_produtos $bancos_produtos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bancos_produtos $bancos_produtos)
    {
        //
    }
}
