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
        Schema::create('reportestiempos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->time('hora_inicial');
            $table->time('hora_final')->nullable();
            $table->integer('duracion')->nullable(); // duración en segundos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportestiempos');
    }
};
