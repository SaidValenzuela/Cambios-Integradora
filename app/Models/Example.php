<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    // Especificar la tabla si el nombre no sigue la convención
    // protected $table = 'trips';

    // Especificar los campos que se pueden llenar en masa
    protected $fillable = [
        'portada',
        'titulo',
        'tipo',
        'descripcion',
        'fecha_salida',
    ];
}
