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
        Schema::create('nota_ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('monto_total');
            $table->date('fecha');
            $table->unsignedBigInteger('promotor_id');
            $table->foreign('promotor_id')->references('id')->on('promotors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_ventas');
    }
};
