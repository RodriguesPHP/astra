<?php

namespace App\Http\Controllers;

use App\Models\Apps;
use App\Models\Bancos;
use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class AppsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bancos = Bancos::all();
        $produtos = Produtos::all();
        $apps = Apps::where('user_id', '=', Auth::id())->get();

        return view('apps.index',compact('bancos','produtos','apps'));
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
        $request->validate([
            'nome' => 'required',
            'banco' => 'required',
            'produto' => 'required',
            'usuario' => 'required',
            'senha' => 'required'
        ]);

        $app = new Apps;
        $app->uuid = Uuid::uuid4()->toString();
        $app->user_id = Auth::user()->id;
        $app->banco_id = $request->banco;
        $app->produto = $request->produto;
        $app->nome = $request->nome;
        $app->usuario = $request->usuario;
        $app->senha = $request->senha;
        $app->client_id = $request->apikey;
        $app->secret_id = $request->secretkey;
        $app->cpfagente = $request->usuario_digitador;
        $app->usuariodigitador = $request->cpf_digitador;
        $app->path = '/a';
        $app->ordem = '["CONSULTA","DIGITAÇÃO","LOTE"]';

        $app->save();

        if($app){
            return redirect()->route('apps.index')->with('success','Aplicativo criado com sucesso!');
        }else{
            return redirect()->route('apps.index')->with('error','Erro ao criar aplicativo!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Apps $apps)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apps $apps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apps $apps)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apps $apps)
    {
        //
    }
}
