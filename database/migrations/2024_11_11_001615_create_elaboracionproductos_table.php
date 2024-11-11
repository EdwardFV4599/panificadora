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
        Schema::create('elaboracionproductos', function (Blueprint $table) {
            $table->id();
            $table->string('producto');
            $table->decimal('cantidad_elaborada', 10, 0);
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
        Schema::dropIfExists('elaboracionproductos');
    }
};
