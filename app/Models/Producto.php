<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'talla',
        'color',
        'precio',
        'id_categoria'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function inventario()
{
    return $this->hasOne(
        Inventario::class,
        'id_producto',
        'id_producto'
    );
}


public function movimientos()
{
    return $this->hasMany(
        MovimientoInventario::class,
        'id_producto',
        'id_producto'
    );
}

public function detalleReservas()
{
    return $this->hasMany(
        DetalleReserva::class,
        'id_producto',
        'id_producto'
    );
}

public function detalleVentas()
{
    return $this->hasMany(
        DetalleVenta::class,
        'id_producto',
        'id_producto'
    );
}

public function devoluciones()
{
    return $this->hasMany(
        Devolucion::class,
        'id_producto',
        'id_producto'
    );
}
}