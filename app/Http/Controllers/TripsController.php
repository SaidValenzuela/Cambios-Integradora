<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripsController extends Controller
{
    public function viewViajess()
    {
        // Verifica si la vista se está cargando correctamente
        return view('cruds.tripss');
    }
}
