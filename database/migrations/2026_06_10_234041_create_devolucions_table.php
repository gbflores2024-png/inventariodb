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
    Schema::create('devoluciones', function (Blueprint $table) {

        $table->id('id_devolucion');

        $table->unsignedBigInteger('id_venta');

        $table->unsignedBigInteger('id_producto');

        $table->integer('cantidad');

        $table->string('motivo');

        $table->string('estado');

        $table->date('fecha_devolucion');

        $table->timestamps();

        $table->foreign('id_venta')
              ->references('id_venta')
              ->on('ventas')
              ->onDelete('cascade');

        $table->foreign('id_producto')
              ->references('id_producto')
              ->on('productos')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('devoluciones');
}
};
