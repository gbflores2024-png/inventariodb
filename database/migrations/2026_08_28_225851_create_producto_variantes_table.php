
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto_variantes', function (Blueprint $table) {

            $table->id('id_variante');

            // Relación con productos
            $table->unsignedBigInteger('id_producto');

            $table->string('talla', 10);

            $table->string('color', 50);

            $table->decimal('precio', 10, 2);

            $table->timestamps();

            $table->foreign('id_producto')
                  ->references('id_producto')
                  ->on('productos')
                  ->onDelete('cascade');

            $table->unique([
                'id_producto',
                'talla',
                'color'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto_variantes');
    }
};
