<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $primaryKey = 'id_pago';
public $timestamps = false;
    protected $fillable = [
        'id_reserva',
        'metodo_pago',
        'monto',
        'fecha_pago',
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
}