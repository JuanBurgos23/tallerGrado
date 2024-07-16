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
        Schema::create('denunciante', function (Blueprint $table) {
            $table->id();
            $table->string('ci')->unique();
            $table->string('nombre');
            $table->string('paterno');
            $table->string('materno');
            $table->string('sexo');
            $table->string('domicilio');
            $table->string('telefono')->nullable();
            $table->string('edad');
            $table->string('estado_civil');
            $table->date('fecha_nac')->nullable();
            $table->string('nacionalidad');
            $table->string('natural_de');
            $table->string('ocupacion');
            $table->timestamps('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('denunciante');
    }
};
