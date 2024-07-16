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
        Schema::create('denunciado_denuncia', function (Blueprint $table) {
            $table->unsignedBigInteger('id_denunciado');
            $table->unsignedBigInteger('id_denuncia');
            $table->foreign('id_denunciado')->references('id')->on('denunciado');
            $table->foreign('id_denuncia')->references('id')->on('denuncia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denunciado_denuncia');
    }
};
