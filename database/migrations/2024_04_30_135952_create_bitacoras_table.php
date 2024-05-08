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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion')->nullable();
            $table->string('usuario')->nullable();
            $table->string('usuario_id')->nullable();
            $table->string('direccion_ip')->nullable();
            $table->text('navegador')->nullable();
            $table->string('tabla')->nullable();
            $table->string('registro_id')->nullable();
            $table->dateTime('fecha_hora')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacoras');
    }
};
