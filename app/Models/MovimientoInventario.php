<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    protected $table = 'movimiento_inventarios';

    protected $primaryKey = 'id_movimiento';
public $timestamps = false;
    protected $fillable = [
        'id_producto',
        'tipo_movimiento',
        'cantidad',
        'motivo',
        'fecha_movimiento'
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