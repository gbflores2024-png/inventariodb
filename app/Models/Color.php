<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// NUEVO: modelo para el catálogo de colores.
class Color extends Model
{
    protected $table = 'colores';

    protected $primaryKey = 'id_color';

    // NUEVO: la tabla no tiene timestamps.
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'codigo_hex',
    ];

    // NUEVO: un color puede utilizarse
    // en diferentes variantes de productos.
    public function variantes()
    {
        return $this->hasMany(
            ProductoVariante::class,
            'id_color',
            'id_color'
        );
    }
}
