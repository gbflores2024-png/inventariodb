<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    protected $primaryKey = 'id_reserva';

    public $timestamps = false;

    protected $fillable = [
        'id_cliente',
        'fecha_reserva',
        'estado',
        'total'
    ];

    public function cliente()
    {
        return $this->belongsTo(
            Cliente::class,
            'id_cliente',
            'id_cliente'
        );
    }

    public function pagos()
    {
        return $this->hasMany(
            Pago::class,
            'id_reserva',
            'id_reserva'
        );
    }

    public function pedidos()
    {
        return $this->hasMany(
            Pedido::class,
            'id_reserva',
            'id_reserva'
        );
    }

    // Detalles y productos de la reserva
    public function detalleReservas()
    {
        return $this->hasMany(
            DetalleReserva::class,
            'id_reserva',
            'id_reserva'
        );
    }
}