<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['proveedor_id', 'nombre', 'unidadMedida', 'stock', 'stockMinimo', 'registradoPor'];

    // Un Producto pertenece a un Proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    // Un Producto aparece en muchos DetallesCompra
    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class, 'producto_id');
    }
}