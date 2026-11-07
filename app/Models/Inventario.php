<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';

    protected $primaryKey = 'id_inventario';

    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'id_variante',
        'inventario_fisico',
        'stock_disponible',
        'stock_reservado',
        'stock_minimo',
        'fecha_actualizacion',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON PRODUCTO
    |--------------------------------------------------------------------------
    */

    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'id_producto',
            'id_producto'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON VARIANTE
    |--------------------------------------------------------------------------
    */

    public function variante()
    {
        return $this->belongsTo(
            ProductoVariante::class,
            'id_variante',
            'id_variante'
        );
    }
}