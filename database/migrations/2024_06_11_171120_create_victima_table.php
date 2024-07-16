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
        Schema::create('victima', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos')->nullable();
            $table->string('ci')->unique()->nullable();
            $table->date('fecha_nac')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('sexo')->nullable();
            $table->string('edad')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('victima');
    }
};
