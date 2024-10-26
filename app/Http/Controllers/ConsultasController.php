<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use App\Models\Bancos_produtos;
use App\Models\Consultas;
use App\Models\FilaConsulta;
use App\Rules\Cpf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bancos = Bancos_produtos::with('produto','bancos')->where('produto_id',1)->get();
        $consultas = Consultas::where('user_id',Auth::id())->with('bancos')->limit(20)->orderby('created_at','desc')->get();
        return view('consulta.index',compact('bancos','consultas'));
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
        try {
            $messages = [
                'cpf.required' => 'CPF é obrigatório',
                'cpf.cpf' => 'O CPF é inválido.',
                'parcelas.required' => 'Parcelas são obrigatórias',
                'bancos.required' => 'Selecione um banco',
            ];

            // Validação dos dados
            $validade = $request->validate([
                'cpf' => ['required', new Cpf()],
                'parcelas' => 'required',
                'bancos' => 'required|array',
            ], $messages);

            // Processa cada banco
            foreach ($validade['bancos'] as $banco) {
                $consulta = new Consultas;
                $consulta->uuid = Uuid::uuid4()->toString();
                $consulta->user_id = Auth::user()->id;
                $consulta->cpf = $validade['cpf'];
                $consulta->banco_id = $banco;
                $consulta->parcelas = $validade['parcelas'];
                $consulta->save();

                // Envia a consulta para fila de processamento
                $fila_consulta = new FilaConsulta;
                $fila_consulta->uuid = Uuid::uuid4()->toString();
                $fila_consulta->user_id = $consulta->user_id;
                $fila_consulta->uuid_job = $consulta->uuid;
                $fila_consulta->banco_id = $consulta->banco_id;
                $fila_consulta->save();
            }

            return redirect()->back()->with('success', 'Consulta registrada com sucesso!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao registrar a consulta.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Consultas $consultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consultas $consultas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consultas $consultas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consultas $consultas)
    {
        //
    }
}
