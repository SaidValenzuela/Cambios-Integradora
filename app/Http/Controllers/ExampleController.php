<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function viewExample()
    {
        return view('cruds.example');  // Asegúrate de que la vista esté en la carpeta correcta
    }
}

// php artisan config:cache
// php artisan route:cache
// php artisan view:clear