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
        Schema::create('denuncia', function (Blueprint $table) {
            $table->id();
            $table->string('lugar_hecho');
            $table->date('fecha_hecho');
            $table->string('hora_hecho');
            $table->string('instrumento_utilizado')->nullable();
            $table->string('declaracion');
            $table->unsignedBigInteger('id_ubicacion')->nullable();
            $table->unsignedBigInteger('id_denunciante')->nullable();
            $table->unsignedBigInteger('id_oficial')->nullable();
            $table->unsignedBigInteger('id_fiscal')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->string('estado')->nullable();
            $table->string('recepcionado')->nullable();
            $table->string('declaracion_formal')->nullable();
            $table->foreign('id_ubicacion')->references('id')->on('ubicacion');
            $table->foreign('id_denunciante')->references('id')->on('denunciante');
            $table->foreign('id_oficial')->references('id')->on('oficial');
            $table->foreign('id_fiscal')->references('id')->on('fiscal');
            $table->foreign('id_user')->references('id')->on('users');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denuncia');
    }
};
