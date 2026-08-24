<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {

            $table->id('id_pedido');

            $table->unsignedBigInteger('id_reserva');

            $table->date('fecha_pedido');

            $table->string('estado');

            $table->timestamps();

            $table->foreign('id_reserva')
                  ->references('id_reserva')
                  ->on('reservas')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};