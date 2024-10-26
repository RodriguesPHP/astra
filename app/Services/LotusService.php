<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LotusService
{
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.lotus.url');
    }

    public function getToken(array $credentials)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($this->baseUri.'/v1/auth/signin',$credentials);

        if ($response->successful()) {
            return $response->json()['token'];
        }

        return response()->json($response->json(),$response->status());
    }

    public function createConsulta(array $credentials,array $client)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization'=>'Bearer '.$this->getToken($credentials),
        ])->post($this->baseUri . '/v1/fgts/create-simulation',[
            "cpf"=>$client['cpf'],
            "interestRate"=>0.0180,
            "numberOfPeriods"=>10,
            "hasInsurance"=>true
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json($response->json(),$response->status());
    }

    public function getBalance(array $credentials,string $id)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'authorization'=>'Bearer '.$this->getToken($credentials),
        ])->get($this->baseUri . '/v1/fgts/simulation/'.$id);

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json($response->json(),$response->status());
    }

    public function processConsulta(array $credentials, array $client,int $attempt = 1)
    {
        $consultaResponse = $this->createConsulta($credentials, $client);
        sleep(1);
        if ($consultaResponse['status'] === 'ERROR') {
            return ['error' => $consultaResponse['message']];
        } elseif ($consultaResponse['status'] === 'COMPLETED') {
            $balanceResponse = $this->getBalance($credentials, $consultaResponse['id']);
            return $balanceResponse;
        } elseif ($consultaResponse['status'] === 'PENDING') {
            sleep(15);
            if ($attempt < 5) {
                return $this->processConsulta($credentials, $client, $attempt + 1);
            } else {
                return ['error' => 'O status ainda está PENDING após várias tentativas.'];
            }
        }
        return ['error' => 'Status não reconhecido'];
    }

}
