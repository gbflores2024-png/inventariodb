<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoVariante extends Model
{
    protected $table = 'producto_variantes';

    protected $primaryKey = 'id_variante';

    // MODIFICADO: agregamos las nuevas claves foráneas.
    protected $fillable = [
        'id_producto',
        'talla',
        'color',
        'id_talla',
        'id_color',
        'precio',
    ];

    // RELACIÓN EXISTENTE: producto al que pertenece.
    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'id_producto',
            'id_producto'
        );
    }

    // RELACIÓN EXISTENTE: inventario de la variante.
    public function inventario()
    {
        return $this->hasOne(
            Inventario::class,
            'id_variante',
            'id_variante'
        );
    }

    // NUEVO: relación con el catálogo de tallas.
    public function tallaCatalogo()
    {
        return $this->belongsTo(
            Talla::class,
            'id_talla',
            'id_talla'
        );
    }

    // NUEVO: relación con el catálogo de colores.
    public function colorCatalogo()
    {
        return $this->belongsTo(
            Color::class,
            'id_color',
            'id_color'
        );
    }
}
