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
        Schema::create('fila_consultas', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->foreignId('user_id')->constrained('users');
            $table->string('uuid_job')->index();
            $table->foreignId('banco_id')->constrained('bancos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fila_consultas');
    }
};
