<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// NUEVO: modelo para las tallas de bebés, niños y juveniles.
class Talla extends Model
{
    protected $table = 'tallas';

    protected $primaryKey = 'id_talla';

    // NUEVO: la tabla no tiene timestamps.
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'grupo',
    ];

    // NUEVO: una talla puede pertenecer
    // a muchas variantes de productos.
    public function variantes()
    {
        return $this->hasMany(
            ProductoVariante::class,
            'id_talla',
            'id_talla'
        );
    }
}
