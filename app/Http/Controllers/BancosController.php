<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use Illuminate\Http\Request;

class BancosController extends Controller
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
        $banco = new Bancos;

        $banco->prefix = $request->prefix;
        $banco->nome = $request->nome;

        $banco->save();

        if($banco){
            return redirect()->back()->with('success', 'Banco cadastrado com sucesso!');
        }

        return redirect()->back()->with('error', 'Não foi possivel cadastrar o banco!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Bancos $bancos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bancos $bancos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bancos $bancos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bancos $bancos)
    {
        //
    }
}
