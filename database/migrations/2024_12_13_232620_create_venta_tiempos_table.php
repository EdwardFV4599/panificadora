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
        Schema::create('venta_tiempos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_venta');
            $table->date('fecha_venta');
            $table->timestamp('tiempo_inicial');
            $table->timestamp('tiempo_final')->nullable();
            $table->integer('duracion')->nullable(); // duración en segundos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venta_tiempos');
    }
};
