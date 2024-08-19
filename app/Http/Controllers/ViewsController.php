<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Trip; // Asegúrate de importar el modelo Trip
use Illuminate\Http\Request;

class ViewsController extends Controller
{
    public function viewDashboard(){
        return view('templates.crud');
    }

    public function viewViajes(){
        // Obtener todos los viajes desde la base de datos
        $trips = Trip::all();

        // Pasar los datos de los viajes a la vista
        return view('viajes', compact('trips'));
    }
}
