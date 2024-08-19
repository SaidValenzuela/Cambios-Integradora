<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TripController extends Controller
{
    public function viewViajes()
    {
        $trips = Trip::all();
        return view('cruds.trips', compact('trips'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'portada' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'titulo' => 'required|string|max:250',
            'tipo' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_salida' => 'required|date',
        ]);

        // Manejar la carga de la imagen
        if ($request->hasFile('portada')) {
            $imagePath = $request->file('portada')->store('public/portadas');
            $portadaUrl = Storage::url($imagePath);
        } else {
            $portadaUrl = null;
        }

        // Crear un nuevo viaje o actualizar uno existente
        if ($request->has('tripId') && $request->tripId) {
            $trip = Trip::findOrFail($request->tripId);
            $trip->update([
                'portada' => $portadaUrl ?? $trip->portada,
                'titulo' => $request->input('titulo'),
                'tipo' => $request->input('tipo'),
                'descripcion' => $request->input('descripcion'),
                'fecha_salida' => $request->input('fecha_salida'),
            ]);
        } else {
            Trip::create([
                'portada' => $portadaUrl,
                'titulo' => $request->input('titulo'),
                'tipo' => $request->input('tipo'),
                'descripcion' => $request->input('descripcion'),
                'fecha_salida' => $request->input('fecha_salida'),
            ]);
        }

        return redirect()->route('trips')->with('success', 'Viaje guardado con éxito');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'portada' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'titulo' => 'required|string|max:250',
            'tipo' => 'required|string',
            'descripcion' => 'required|string',
            'fecha_salida' => 'required|date',
        ]);

        $trip = Trip::findOrFail($id);

        // Manejar la carga de la imagen
        if ($request->hasFile('portada')) {
            // Eliminar la imagen antigua si existe
            if ($trip->portada) {
                Storage::delete('public/portadas/' . basename($trip->portada));
            }
            $imagePath = $request->file('portada')->store('public/portadas');
            $portadaUrl = Storage::url($imagePath);
        } else {
            $portadaUrl = $trip->portada;
        }

        $trip->update([
            'portada' => $portadaUrl,
            'titulo' => $request->input('titulo'),
            'tipo' => $request->input('tipo'),
            'descripcion' => $request->input('descripcion'),
            'fecha_salida' => $request->input('fecha_salida'),
        ]);

        return redirect()->route('trips')->with('success', 'Viaje actualizado con éxito');
    }

    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);

        // Eliminar la imagen si existe
        if ($trip->portada) {
            Storage::delete('public/portadas/' . basename($trip->portada));
        }

        $trip->delete();
        
        return redirect()->route('trips')->with('success', 'Viaje eliminado exitosamente');
    }
}
