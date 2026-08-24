<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $primaryKey = 'id_venta';
public $timestamps = false;
    protected $fillable = [
        'id_pedido',
        'fecha_venta',
        'total'
    ];

    public function pedido()
    {
        return $this->belongsTo(
            Pedido::class,
            'id_pedido',
            'id_pedido'
        );
    }

    public function detalles()
{
    return $this->hasMany(
        DetalleVenta::class,
        'id_venta',
        'id_venta'
    );
}

public function devoluciones()
{
    return $this->hasMany(
        Devolucion::class,
        'id_venta',
        'id_venta'
    );
}
}