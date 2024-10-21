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
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->string('producto');
            $table->string('proveedor');
            $table->decimal('existencia_inicial', 10, 2);
            $table->decimal('existencia_actual', 10, 2);
            $table->decimal('precio', 10, 2);
            $table->string('encargado');
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->integer('eliminado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
