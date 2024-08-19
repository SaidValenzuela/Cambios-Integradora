<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{

    public function index()
    {
        $reservations = Reservation::all(); // Obtén todas las reservas
        return view('reservations', compact('reservations')); // Pasa las reservas a la vista
    }

    public function viewReservaciones()
    {
        $reservations = Reservation::all();
        return view('cruds.reservations', compact('reservations'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'viaje' => 'required|string|max:255',
            'pasajeros_adultos' => 'required|integer|min:0',
            'pasajeros_menores' => 'nullable|integer|min:0',
            'fecha_pagar' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Calcular el total de pasajeros
        $totalPasajeros = $request->input('pasajeros_adultos') + ($request->input('pasajeros_menores') ?? 0);

        // Crear una nueva reserva
        $reservation = new Reservation();
        $reservation->nombre = $request->input('nombre');
        $reservation->email = $request->input('correo');
        $reservation->viaje = $request->input('viaje');
        $reservation->pasajeros_adultos = $request->input('pasajeros_adultos');
        $reservation->pasajeros_menores = $request->input('pasajeros_menores') ?? 0;
        $reservation->total_pasajeros = $totalPasajeros;
        $reservation->fecha_pagar = $request->input('fecha_pagar');
        $reservation->save();

        // Redirigir o devolver una respuesta
        return redirect()->back()->with('success', 'Reserva realizada con éxito');
    }
}
