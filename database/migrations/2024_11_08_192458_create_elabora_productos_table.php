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
        Schema::create('elabora_productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->decimal('existencia_actual', 10, 2);
            $table->string('unidad');
            $table->decimal('precio', 10, 2);
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
        Schema::dropIfExists('elabora_productos');
    }
};
