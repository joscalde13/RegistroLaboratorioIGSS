<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Examen;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{

    public function index(Request $request)
    {
            $query = Examen::query();
            
            
            if ($request->has('search')) {
                $search = $request->input('search');
                if (trim($search) !== '') {
                    $query->where(function($q) use ($search) {
                        $q->where('nombre', 'like', "%$search%")
                          ->orWhere('apellido', 'like', "%$search%")
                          ->orWhere('numero_afiliacion', 'like', "%$search%");
                    });
                }
            }
        $examens = $query->orderBy('id')->get(); // Orden ascendente: antiguos arriba, nuevos abajo
            return view('examens.index', compact('examens'));
    }




    public function exportPdf()
    {
        $examens = Examen::all();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('examens.pdf', compact('examens'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('ExamenesLaboratorio.pdf');
    }





    public function create()
    {
        $currentMonth = now()->format('Y-m');
        $lastCorrelativo = \App\Models\Examen::whereRaw("strftime('%Y-%m', fecha) = ?", [$currentMonth])
            ->max('correlativo');
        $nextCorrelativo = ($lastCorrelativo ?? 0) + 1;

         return view('examens.create', compact('nextCorrelativo'));

    }




    public function store(Request $request)
    {

            $data = $request->validate([
                'numero_afiliacion' => 'required',
                'nombre' => 'required',
                'apellido' => 'required',
                'sexo' => 'required',
                'calidad' => 'required',
                'edad' => 'required|integer',
                'unidad' => 'required',
                'area' => 'required',
                'programa' => 'required',
                'seccion' => 'required',
                'perfil' => 'required',
                'pruebas' => 'required',
            ]);


            $data['fecha'] = now();
            $currentMonth = now()->format('Y-m');
            $lastCorrelativo = \App\Models\Examen::whereRaw("strftime('%Y-%m', fecha) = ?", [$currentMonth])
                ->max('correlativo');
            $data['correlativo'] = ($lastCorrelativo ?? 0) + 1;
            $data['pruebas'] = json_encode($request->input('pruebas'));
            Examen::create($data);

            return redirect()->route('examens.index')->with('success', 'Examen registrado correctamente');


    }





    public function edit($id)
    {
        $examen = Examen::findOrFail($id);
        return view('examens.edit', compact('examen'));
    }




    public function update(Request $request, $id)
    {
        $examen = Examen::findOrFail($id);
        $data = $request->validate([
            'numero_afiliacion' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'sexo' => 'required',
            'calidad' => 'required',
            'edad' => 'required|integer',
            'unidad' => 'required',
            'area' => 'required',
            'programa' => 'required',
            'seccion' => 'required',
            'perfil' => 'required',
            'pruebas' => 'required',
        ]);

        $data['pruebas'] = json_encode($request->input('pruebas'));

        $examen->update($data);
        
        return redirect()->route('examens.index')->with('success', 'Examen actualizado correctamente');
    }





    public function stats()
    {
        $totales = [
            'sexo' => Examen::select('sexo', DB::raw('count(*) as total'))->groupBy('sexo')->get(),
            'calidad' => Examen::select('calidad', DB::raw('count(*) as total'))->groupBy('calidad')->get(),
            'edad' => Examen::select('edad', DB::raw('count(*) as total'))->groupBy('edad')->get(),
            'unidad' => Examen::select('unidad', DB::raw('count(*) as total'))->groupBy('unidad')->get(),
            'area' => Examen::select('area', DB::raw('count(*) as total'))->groupBy('area')->get(),
            'programa' => Examen::select('programa', DB::raw('count(*) as total'))->groupBy('programa')->get(),
            'seccion' => Examen::select('seccion', DB::raw('count(*) as total'))->groupBy('seccion')->get(),
            'prueba' => [],
        ];

        // Contador por prueba
        $pruebas = Examen::all()->pluck('pruebas');
        $pruebaContador = [];
        foreach ($pruebas as $pruebasJson) {
            $arr = json_decode($pruebasJson, true);
            if (is_array($arr)) {
                foreach ($arr as $prueba) {
                    if (!isset($pruebaContador[$prueba])) $pruebaContador[$prueba] = 0;
                    $pruebaContador[$prueba]++;
                }
            }
        }
        $totales['prueba'] = $pruebaContador;
        return view('examens.stats', compact('totales'));
    }




    public function destroy($id)
    {
        $examen = Examen::findOrFail($id);
        $examen->delete();
        return redirect()->route('examens.index')->with('success', 'Examen eliminado correctamente');
    }

}