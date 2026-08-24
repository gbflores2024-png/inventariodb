<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    protected $table = 'devoluciones';

    protected $primaryKey = 'id_devolucion';
public $timestamps = false;
    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'motivo',
        'estado',
        'fecha_devolucion'
    ];

    public function venta()
    {
        return $this->belongsTo(
            Venta::class,
            'id_venta',
            'id_venta'
        );
    }

    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'id_producto',
            'id_producto'
        );
    }
}