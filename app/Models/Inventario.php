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
        'inventario_fisico',
        'stock_disponible',
        'stock_reservado',
        'stock_minimo',
        'fecha_actualizacion'
    ];

    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'id_producto',
            'id_producto'
        );
    }
}