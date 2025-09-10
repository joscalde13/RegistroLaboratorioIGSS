<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examen;

class AgendaController extends Controller
{
    public function index()
    {
        // Obtener todas las citas (exámenes con fecha de cita)
    $citas = Examen::whereNotNull('fecha_cita')->where('estado', '!=', 'finalizado')->get();
        return view('agenda.index', compact('citas'));
    }

    public function updateEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,toma de muestras,proceso,finalizado',
        ]);
        $examen = Examen::findOrFail($id);
        $examen->estado = $request->estado;
        $examen->save();
        return redirect()->route('agenda.index')->with('success', 'Estado actualizado correctamente.');
    }
}
