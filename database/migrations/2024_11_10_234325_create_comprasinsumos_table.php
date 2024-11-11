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
        Schema::create('comprasinsumos', function (Blueprint $table) {
            $table->id();
            $table->string('insumo');
            $table->string('proveedor');
            $table->decimal('stock_agregado', 10, 2);
            $table->decimal('precio', 10, 2);
            $table->string('encargado');
            $table->date('fecha');
            $table->text('descripcion')->nullable();
            $table->integer('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comprasinsumos');
    }
};
