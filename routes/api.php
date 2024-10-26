<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->bearerToken();
});


Route::post('/auth',[APIController::class,'auth']);

Route::post('/app',[APIController::class,'callback_App']);

Route::get('/consulta/waiting',[APIController::class,'ConsultaWaiting']);

Route::put('/consulta/{uuid}',[APIController::class,'UpdateConsulta']);


Route::get('/listagem/waiting',[APIController::class,'listagemWaiting']);

Route::put('/listagem/{uuid}',[APIController::class,'UpdateListagem']);
