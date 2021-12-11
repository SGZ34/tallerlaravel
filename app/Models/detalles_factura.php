<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class detalles_factura extends Model
{
    protected $table = 'detalles_factura';
    protected $fillable = ['idFactura', 'idProducto', 'cantidad', 'precioUnidad', 'subtotal'];
    public $timestamps = false;
}
