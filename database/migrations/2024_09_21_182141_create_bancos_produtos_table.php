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
        Schema::create('bancos_produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banco_id')->constrained('bancos','id')->onDelete('cascade');
            $table->foreignId('produto_id')->constrained('produtos','id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bancos_produtos');
    }
};
