<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('welcome');

Route::prefix('consulta')->group(function(){
    Route::get('/', [\App\Http\Controllers\ConsultasController::class, 'index'])->name('consulta')->middleware('auth');
    Route::post('/', [\App\Http\Controllers\ConsultasController::class, 'store'])->name('consulta.store')->middleware('auth');
});

Route::prefix('campanhas')->group(function () {
    Route::get('/',[\App\Http\Controllers\ListagensController::class,'index'])->name('campanhas.index')->middleware('auth');
    Route::get('/{banco}/{produto}/new',[\App\Http\Controllers\ListagensController::class,'indexPerfil'])->name('campanhas.new')->middleware('auth');
    Route::post('/{banco}/{produto}/new',[\App\Http\Controllers\ListagensController::class,'store'])->name('campanhas.store')->middleware('auth');
});

Route::prefix('apps')->group(function () {
    Route::get('/',[\App\Http\Controllers\AppsController::class,'index'])->name('apps.index')->middleware('auth');
    Route::post('/',[\App\Http\Controllers\AppsController::class,'store'])->name('apps.store')->middleware('auth');
});

Route::prefix('admin')->group(function () {
    Route::get('/users',[AdminController::class,'users_index'])->name('admin.users');
    Route::get('/produtos',[AdminController::class,'produtos_index'])->name('admin.produtos');
    Route::post('/produtos/banco',[\App\Http\Controllers\BancosController::class,'store'])->name('store.banco');
    Route::post('/produtos/produto',[\App\Http\Controllers\ProdutosController::class,'store'])->name('store.produto');
    Route::post('/produtos/produtoslistados',[\App\Http\Controllers\BancosProdutosController::class,'store'])->name('store.produtoslistados');
});

Route::prefix('auth')->group(function () {
    Route::get('/login',[\App\Http\Controllers\AuthController::class,'index'])->name('login');
    Route::post('/login',[\App\Http\Controllers\AuthController::class,'login'])->name('auth.login');
});
