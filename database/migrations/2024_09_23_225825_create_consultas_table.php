<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('cpf');
            $table->foreignId('banco_id')->constrained('bancos')->onDelete('cascade');
            $table->integer('parcelas');
            $table->string('saldo')->nullable();
            $table->string('saldo_lib')->nullable();
            $table->integer('sit')->default(0);
            $table->text('parcelas_banco')->nullable();
            $table->string('idsimulacao')->nullable();
            $table->string('taxa')->default('0');
            $table->string('log')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
