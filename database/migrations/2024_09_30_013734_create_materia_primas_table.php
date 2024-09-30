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
        Schema::create('materia_primas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('cantidad', 8, 2); // Cantidad disponible
            $table->string('unidad'); // Unidad de medida (kg, litros, etc.)
            $table->decimal('precio', 10, 2); // Precio por unidad
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->timestamps(); // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_primas');
    }
};
