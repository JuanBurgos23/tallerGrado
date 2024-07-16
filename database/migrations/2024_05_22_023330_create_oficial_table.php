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
        Schema::create('oficial', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('paterno');
            $table->string('materno');
            $table->string('telefono');
            $table->string('email');
            $table->string('cargo');
            $table->string('estado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oficial');
    }
};
