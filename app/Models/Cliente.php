<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion'
    ];

    public function reservas()
{
    return $this->hasMany(
        Reserva::class,
        'id_cliente',
        'id_cliente'
    );
}
}