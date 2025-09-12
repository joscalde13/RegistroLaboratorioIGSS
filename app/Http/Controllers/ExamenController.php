<?php

namespace App\Http\Controllers;

use App\Exports\ExamensExport;
use Excel;
use Illuminate\Http\Request;
use App\Models\Examen;
use Illuminate\Support\Facades\DB;

class ExamenController extends Controller
{
    public function statsExcel()
    {
        $totales = [];
        $cats = ['sexo','calidad','edad','unidad','area','programa','seccion'];
        $totales[] = ['Categoría', 'Valor', 'Total']; 
        foreach ($cats as $cat) {
            $items = Examen::select($cat, DB::raw('count(*) as total'))->groupBy($cat)->get();
            foreach ($items as $item) {
                $totales[] = [ucfirst($cat), $item->$cat, $item->total];
            }
        }

        
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
        foreach ($pruebaContador as $prueba => $total) {
            $totales[] = ['Prueba', $prueba, $total];
        }
        $filename = 'EstadisticasExamenesLaboratorio.csv';
        $handle = fopen('php://temp', 'r+');
        foreach ($totales as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
    public function statsPdf()
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

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('examens.stats-pdf', compact('totales'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('EstadisticasExamenesLaboratorio.pdf');
    }
    public function historialPaciente($numeroAfiliacion)
    {
        $paciente = \App\Models\Paciente::where('numero_afiliacion', $numeroAfiliacion)->first();
        $historial = Examen::where('numero_afiliacion', $numeroAfiliacion)
            ->where('estado', 'finalizado')
            ->orderBy('fecha', 'desc')->get();
        return view('examens.historial', [
            'historial' => $historial,
            'paciente' => $paciente,
            'numeroAfiliacion' => $numeroAfiliacion
        ]);
    }

    public function exportExcel()
    {
        $headers = [
            'Correlativo', 'Fecha', 'N° Afiliación', 'Nombre', 'Apellido', 'Sexo', 'Calidad', 'Edad', 'Unidad', 'Área', 'Programa', 'Sección', 'Perfil', 'Pruebas', 'Estado'
        ];
        $examens = Examen::select('correlativo', 'fecha', 'numero_afiliacion', 'nombre', 'apellido', 'sexo', 'calidad', 'edad', 'unidad', 'area', 'programa', 'seccion', 'perfil', 'pruebas', 'estado')->get();
        $filename = 'ExamenesLaboratorio.csv';
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $headers);
        foreach ($examens as $examen) {
            fputcsv($handle, [
                $examen->correlativo,
                $examen->fecha,
                $examen->numero_afiliacion,
                $examen->nombre,
                $examen->apellido,
                $examen->sexo,
                $examen->calidad,
                $examen->edad,
                $examen->unidad,
                $examen->area,
                $examen->programa,
                $examen->seccion,
                $examen->perfil,
                $examen->pruebas,
                $examen->estado
            ]);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);
        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }

    public function index(Request $request)
    {
        $query = Examen::query();
        
        if ($request->has('search')) {
            $search = $request->input('search');
            if (trim($search) !== '') {
                // Detectar formato DD-MM-YYYY y convertir a YYYY-MM-DD
                $searchDate = $search;
                if (preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $search, $matches)) {
                    $searchDate = $matches[3] . '-' . $matches[2] . '-' . $matches[1];
                }
                $query->where(function($q) use ($search, $searchDate) {
                    // Prioridad: día, mes, año, luego otros campos
                    $q->orWhereRaw("strftime('%d', fecha) LIKE ?", ["%$search%"]);
                    $q->orWhereRaw("strftime('%m', fecha) LIKE ?", ["%$search%"]);
                    $q->orWhereRaw("strftime('%Y', fecha) LIKE ?", ["%$search%"]);
                    $q->orWhereRaw("DATE(fecha) LIKE ?", ["%$searchDate%"]);
                    $fields = [
                        'correlativo', 'fecha', 'numero_afiliacion', 'nombre', 'apellido', 'sexo', 'calidad', 'edad',
                        'unidad', 'area', 'programa', 'seccion', 'perfil', 'pruebas', 'estado'
                    ];
                    foreach ($fields as $field) {
                        $q->orWhere($field, 'like', "%$search%");
                    }
                });
            }
        }
        $query->where('estado', 'finalizado');
        $examens = $query->orderBy('id')->get(); 
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
        $currentMonth = now()->format('Y-%m');
        $lastCorrelativo = \App\Models\Examen::whereRaw("DATE_FORMAT(fecha, '%Y-%m') = ?", [$currentMonth])
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
            'fecha_cita' => 'required|date',
        ]);

        // Crear perfil de paciente si no existe
        $pacienteData = [
            'numero_afiliacion' => $data['numero_afiliacion'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'sexo' => $data['sexo'],
            'edad' => $data['edad'],
        ];
        \App\Models\Paciente::updateOrCreate(
            ['numero_afiliacion' => $data['numero_afiliacion']],
            $pacienteData
        );

        $data['estado'] = 'pendiente';
        $data['fecha'] = now();
        $currentMonth = now()->format('Y-m');
        $lastCorrelativo = \App\Models\Examen::where('numero_afiliacion', $data['numero_afiliacion'])
            ->whereRaw("DATE_FORMAT(fecha, '%Y-%m') = ?", [$currentMonth])
            ->max('correlativo');
        $data['correlativo'] = ($lastCorrelativo ?? 0) + 1;
        $data['pruebas'] = json_encode($request->input('pruebas'));
        Examen::create($data);

        return redirect()->route('agenda.index')->with('success', 'Examen registrado correctamente');


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