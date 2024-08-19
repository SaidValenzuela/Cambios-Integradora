<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // Especificar la tabla si el nombre no sigue la convención
    // protected $table = 'reservations';

    // Especificar los campos que se pueden llenar en masa
    protected $fillable = [
        'nombre',
        'email',
        'viaje',
        'pasajeros_adultos',
        'pasajeros_menores',
        'total_pasajeros',
        'fecha_pagar',
    ];

    protected $casts = [
        'fecha_pagar' => 'datetime',
    ];
}
