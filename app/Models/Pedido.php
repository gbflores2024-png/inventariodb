<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $primaryKey = 'id_pedido';
public $timestamps = false;
    protected $fillable = [
        'id_reserva',
        'fecha_pedido',
        'estado'
    ];

    public function reserva()
    {
        return $this->belongsTo(
            Reserva::class,
            'id_reserva',
            'id_reserva'
        );
    }

    public function ventas()
{
    return $this->hasMany(
        Venta::class,
        'id_pedido',
        'id_pedido'
    );
}

}