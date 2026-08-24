<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_reservas', function (Blueprint $table) {

            $table->id('id_detalle_reserva');

            $table->unsignedBigInteger('id_reserva');
            $table->unsignedBigInteger('id_producto');

            $table->integer('cantidad');

            $table->decimal('precio_unitario', 10, 2);

            $table->decimal('subtotal', 10, 2);

            $table->foreign('id_reserva')
                  ->references('id_reserva')
                  ->on('reservas')
                  ->onDelete('cascade');

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_reservas');
    }
};