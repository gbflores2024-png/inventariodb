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


    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON CATEGORÍA
    |--------------------------------------------------------------------------
    */

    public function categoria()
    {
        return $this->belongsTo(
            Categoria::class,
            'id_categoria',
            'id_categoria'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON INVENTARIO
    |--------------------------------------------------------------------------
    */

    public function inventario()
    {
        return $this->hasOne(
            Inventario::class,
            'id_producto',
            'id_producto'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON VARIANTES
    |--------------------------------------------------------------------------
    */

    public function variantes()
    {
        return $this->hasMany(
            ProductoVariante::class,
            'id_producto',
            'id_producto'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON MOVIMIENTOS DE INVENTARIO
    |--------------------------------------------------------------------------
    */

    public function movimientos()
    {
        return $this->hasMany(
            MovimientoInventario::class,
            'id_producto',
            'id_producto'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON DETALLE DE RESERVAS
    |--------------------------------------------------------------------------
    */

    public function detalleReservas()
    {
        return $this->hasMany(
            DetalleReserva::class,
            'id_producto',
            'id_producto'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON DETALLE DE VENTAS
    |--------------------------------------------------------------------------
    */

    public function detalleVentas()
    {
        return $this->hasMany(
            DetalleVenta::class,
            'id_producto',
            'id_producto'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELACIÓN CON DEVOLUCIONES
    |--------------------------------------------------------------------------
    */

    public function devoluciones()
    {
        return $this->hasMany(
            Devolucion::class,
            'id_producto',
            'id_producto'
        );
    }
}