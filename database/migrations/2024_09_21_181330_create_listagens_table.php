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
        Schema::create('listagens', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('banco_id')->constrained('bancos');
            $table->string('tipo');
            $table->string('nome');
            $table->integer('sit')->default(0);
            $table->integer('registros')->default(0);
            $table->integer('processados')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listagens');
    }
};
