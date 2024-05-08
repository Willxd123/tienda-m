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
        Schema::create('opcion_producto', function (Blueprint $table) {
            $table->id();
            $table->string('valor');
            $table->foreignId('producto_id')
            ->constrained();

            $table->foreignId('opcion_id')
            ->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opcion_producto');
    }
};
