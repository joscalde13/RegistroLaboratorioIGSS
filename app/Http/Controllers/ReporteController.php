<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examen;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{

    public function index()
    {
        $anios = Examen::selectRaw('YEAR(fecha) as anio')
            ->distinct()
            ->orderBy('anio', 'desc')
            ->pluck('anio');
        return view('reportes.index', compact('anios'));
    }

    
    public function meses($anio)
    {
        $meses = Examen::selectRaw('MONTH(fecha) as mes')
            ->whereYear('fecha', $anio)
            ->distinct()
            ->orderBy('mes')
            ->pluck('mes');
        return view('reportes.meses', compact('anio', 'meses'));
    }

    
    public function listado($anio, $mes)
    {
        $examens = Examen::whereYear('fecha', $anio)
            ->whereMonth('fecha', $mes)
            ->orderBy('fecha')
            ->get();
        return view('reportes.listado', compact('anio', 'mes', 'examens'));
    }

   
}
