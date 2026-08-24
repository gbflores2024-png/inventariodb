<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleReserva extends Model
{
    protected $table = 'detalle_reservas';

    protected $primaryKey = 'id_detalle_reserva';

    public $timestamps = false;

    protected $fillable = [
        'id_reserva',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];

    public function reserva()
    {
        return $this->belongsTo(
            Reserva::class,
            'id_reserva',
            'id_reserva'
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