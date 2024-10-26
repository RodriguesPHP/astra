<?php

namespace App\Http\Controllers;

use App\Extra;
use App\Models\Bancos;
use App\Models\Bancos_produtos;
use App\Models\Listagens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ListagensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campanhas = Listagens::where('user_id', Auth::user()->id)->with(['user','banco','produto'])->get();
        return view('campanhas.index', compact('campanhas'));
    }

    public function indexPerfil()
    {
        return view('consultas_lote.index');
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
        try{
            $banco = new Bancos();
            $bancoID = $banco->getIDbyPrefix($request->banco);

            $path = $request->file('file')->store('uploads');

            $fullPath = str_replace('\\', '/',storage_path('app/private/' . $path));

            $campanha = [
                'uuid'=>Uuid::uuid4()->toString(),
                'user_id'=>Auth::user()->id,
                'banco_id'=>$bancoID,
                'tipo'=>$request->produto,
                'nome'=>$request->nome,
                'sit'=>0,
                'registros'=>0,
                'processados'=>0
            ];

            $extra = new Extra();

            if($extra->uploadFile($campanha['uuid'],$fullPath)) {
                Listagens::create($campanha);
                return redirect()->back()->with('success', 'Campanha criada com sucesso');
            }else{
                return redirect()->back()->with('error', 'Erro ao cadastrar campanha');
            }
        }catch (\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Listagens $listagens)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listagens $listagens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listagens $listagens)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listagens $listagens)
    {
        //
    }
}
