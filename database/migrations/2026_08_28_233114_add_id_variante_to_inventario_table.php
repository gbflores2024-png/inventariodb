<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventario', function (Blueprint $table) {

            $table->unsignedBigInteger('id_variante')
                  ->nullable()
                  ->after('id_producto');

            $table->foreign('id_variante')
                  ->references('id_variante')
                  ->on('producto_variantes')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('inventario', function (Blueprint $table) {

            $table->dropForeign(['id_variante']);

            $table->dropColumn('id_variante');
        });
    }
};