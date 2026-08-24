<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventarios', function (Blueprint $table) {

            $table->id('id_inventario');

            $table->unsignedBigInteger('id_producto');

            $table->integer('inventario_fisico');
            $table->integer('stock_disponible');
            $table->integer('stock_reservado')->default(0);
            $table->integer('stock_minimo');

            $table->date('fecha_actualizacion');

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventarios');
    }
};