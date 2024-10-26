<?php

namespace App\Http\Controllers;

use App\Models\Apps;
use App\Models\Consultas;
use App\Models\FilaConsulta;
use App\Models\Lead;
use App\Models\Listagens;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Token;

class APIController extends Controller
{

    private function IsAuth(Request $request)
    {
        if(!$request->bearerToken()){
            return false;
        }
        try{
            $user_id = Token::where('id', $request->bearerToken())->first();
            $user = User::where('id',$user_id->user_id)->first();
            if($user){
                return $user;
            }
        }catch (\Exception $e){
            return false;
        }


        return false;
    }
    public function auth(Request $request)
    {
        // As credenciais já estão validadas
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;

            return response()->json([
                'token_type' => 'Bearer',
                'access_token' => $token,
                'token_id' => $tokenResult->token->id, // ID do token
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function callback_App(Request $request){
        $user = $this->IsAuth($request);
        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $app = Apps::where('user_id',$user->id)->where('uuid',$request->uuid)->first();

        if($app){
            return response()->json(['message' => 'Localizado com sucesso','app'=>$app], 200);
        }

        return response()->json(['message' => 'App não localizado'], 400);

    }

    public function ConsultaWaiting(Request $request)
    {
        $user = $this->IsAuth($request);
        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $consulta = FilaConsulta::where('user_id',$request->user_id)
            ->where('banco_id',$request->banco_id)
            ->first();

        if($consulta){
            $cliente = Consultas::where('uuid',$consulta->uuid_job)->first();
            if($cliente){
                return response()->json(['message' => 'Localizado com sucesso','cliente'=>$cliente,'consulta'=>$consulta], 200);
            }
            return response()->json(['message'=> 'ID Consulta não encontrado','id'=>$consulta->uuid_job], 200);
        }

        return response()->json(['message'=>'Nenhuma consulta aguardando...'],400);
    }

    public function UpdateConsulta(Request $request)
    {
        $user = $this->IsAuth($request);
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $cliente = Consultas::where('uuid',$request->uuid)->first();
        if($cliente){
            $cliente->update([
                'sit' => $request->sit,
                'saldo' => $request->saldo,
                'saldo_lib' => $request->saldo_lib,
                'parcelas_banco' => $request->parcelas,
                'idsimulacao' => $request->idsimulacao,
                'log' => $request->log,
                'updated_at'=>now()
            ]);
        }else {
            return response()->json(['error' => 'Cliente não encontrado'], 400);
        }
        FilaConsulta::where('uuid_job',$request->uuid)->delete();
        return response()->json(['message' => 'Cliente atualizado com sucesso'], 200);
    }

    public function listagemWaiting(Request $request)
    {
        $user = $this->IsAuth($request);
        if(!$user){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $listagem = Listagens::where('user_id',$request->user_id)
            ->where('banco_id',$request->banco_id)
            ->where('tipo',$request->tipo)
            ->where('sit',1)
            ->first();

        if($listagem){
            $cliente = DB::table($listagem->uuid)->where('sit',0)->first();
            if($cliente){
                $cliente->parcelas = 10;
                $cliente->seguro = true;
                return response()->json(['message' => 'Localizado com sucesso','cliente'=>$cliente,'listagem'=>$listagem], 200);
            }
            $listagem->processados = DB::table($listagem->uuid)->where('sit','<>',0)->count();
            $listagem->sit = 2;
            $listagem->save();
            return response()->json(['message' => 'Campanha concluida com sucesso'], 400);
        }

        return response()->json(['message' => 'Nenhuma campanha processando...'], 400);
    }

    public function UpdateListagem(Request $request) {
        $user = $this->IsAuth($request);
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $cliente = DB::table($request->uuid)->where('cpf', $request->cpf)->first();
        if ($cliente) {
            DB::table($request->uuid)->where('cpf', $request->cpf)->update([
                'sit' => $request->sit,
                'saldo' => $request->saldo,
                'saldo_lib' => $request->saldo_lib,
                'parcelas' => $request->parcelas,
                'idsimulacao' => $request->idsimulacao,
                'log' => $request->log,
                'updated_at'=>now()
            ]);
            if($request->sit == "1"){
                $retorno = $this->add_lead($request);
            }
        } else {
            return response()->json(['error' => 'Cliente não encontrado'], 400);
        }
        $this->CountProcessListagem($request->uuid);
        return response()->json(['message' => 'Cliente atualizado com sucesso'], 200);
    }


    private function CountProcessListagem($uuid){
        $listagem = Listagens::where('uuid',$uuid)->first();
        if($listagem){
            $listagem->processados = DB::table($listagem->uuid)->where('sit','<>',0)->count();
            $listagem->save();
        }
    }

    private function add_lead($request){
        $cliente = DB::table($request->uuid)->where('cpf', $request->cpf)->first();

        $dados = [
            'cpf' => $cliente->cpf,
            'nome' => $cliente->nome,
            'telefone' => '',
            'banco' => $this->get_campanha($request->uuid),
            'saldo' => $cliente->saldo,
            'saldo_lib' => $cliente->saldo_lib,
        ];

        $lead = new Lead;
        $lead->cpf = $dados['cpf'];
        $lead->nome = $dados['nome'];
        $lead->telefone = $dados['telefone'];
        $lead->banco = $dados['banco'];
        $lead->saldo = $dados['saldo'];
        $lead->saldo_lib = $dados['saldo_lib'];
        $lead->save();
        return $lead;
    }

    private function get_campanha($uuid){
        $campanha = Listagens::where('uuid',$uuid)->with('banco')->first();
        if($campanha){
            return $campanha->banco->nome;
        }

        return false;
    }

}
