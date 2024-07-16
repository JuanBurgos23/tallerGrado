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
        Schema::create('delito_denuncia', function (Blueprint $table) {
            $table->unsignedBigInteger('id_delito');
            $table->unsignedBigInteger('id_denuncia');
            $table->foreign('id_delito')->references('id')->on('delito');
            $table->foreign('id_denuncia')->references('id')->on('denuncia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delito_denuncia');
    }
};
