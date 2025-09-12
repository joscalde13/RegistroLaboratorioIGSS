<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Examen;
use Carbon\Carbon;

class ExamenMesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Paciente y exámenes de agosto
        \App\Models\Paciente::create([
            'numero_afiliacion' => 'IGSS-1001',
            'nombre' => 'Juan Carlos',
            'apellido' => 'Ramírez',
            'sexo' => 'Masculino',
            'edad' => 28
        ]);


        // Exámenes de agosto para dos pacientes, correlativo reiniciado por paciente
        $examenesAgosto = [
            [
                'fecha' => '2025-08-10',
                'fecha_cita' => '2025-08-15',
                'numero_afiliacion' => 'IGSS-1001',
                'nombre' => 'Juan Carlos',
                'apellido' => 'Ramírez',
                'sexo' => 'Masculino',
                'calidad' => 'AF',
                'edad' => 28,
                'unidad' => 'Patulul',
                'area' => 'Consulta Externa',
                'programa' => 'Enfermedad Común',
                'seccion' => 'Hematología',
                'perfil' => 'Pediatrico',
                'pruebas' => json_encode(['Hemograma']),
                'estado' => 'finalizado',
            ],
            [
                'fecha' => '2025-08-14',
                'fecha_cita' => '2025-08-20',
                'numero_afiliacion' => 'IGSS-1003',
                'nombre' => 'Luis Alberto',
                'apellido' => 'Martínez',
                'sexo' => 'Masculino',
                'calidad' => 'Pen',
                'edad' => 45,
                'unidad' => 'Mazatenango',
                'area' => 'Encamamiento',
                'programa' => 'Traumatología y Ortopedia',
                'seccion' => 'Urología',
                'perfil' => 'Renal',
                'pruebas' => json_encode(['Creatinina']),
                'estado' => 'finalizado',
            ],
        ];
        $correlativos = [];
        foreach ($examenesAgosto as $examen) {
            $key = $examen['numero_afiliacion'] . '-2025-08';
            $correlativos[$key] = ($correlativos[$key] ?? 0) + 1;
            $examen['correlativo'] = $correlativos[$key];
            $examen['created_at'] = now();
            $examen['updated_at'] = now();
            \App\Models\Examen::create($examen);
        }

        // Septiembre: 2 exámenes
        $calidades = ['AF', 'BH', 'Pen', 'BE', 'NA'];
        $fechaSeptiembre = Carbon::create(2025, 9, 5);
        // Septiembre: 2 exámenes, correlativo reiniciado por paciente
        $correlativos = [];
        for ($i = 1; $i <= 2; $i++) {
            $num_afiliacion = 'SEP-00' . $i;
            $key = $num_afiliacion . '-2025-09';
            $correlativos[$key] = ($correlativos[$key] ?? 0) + 1;
            \App\Models\Examen::create([
                'numero_afiliacion' => $num_afiliacion,
                'nombre' => $i === 1 ? 'Ana Sofía' : 'Carlos Enrique',
                'apellido' => $i === 1 ? 'López' : 'Méndez',
                'sexo' => $i === 1 ? 'Femenino' : 'Masculino',
                'calidad' => $calidades[($i+1)%count($calidades)],
                'edad' => $i === 1 ? 22 : 39,
                'unidad' => $i === 1 ? 'Santa Barbara' : 'San Lucas Tolimán',
                'area' => 'Encamamiento',
                'programa' => 'Gineco-Obstetricia',
                'seccion' => 'Coprología',
                'perfil' => 'Perfil',
                'pruebas' => json_encode(['Prueba2']),
                'fecha' => $fechaSeptiembre->copy()->addDays($i),
                'fecha_cita' => $fechaSeptiembre->copy()->addDays($i+2),
                'estado' => $i === 1 ? 'proceso' : 'pendiente',
                'correlativo' => $correlativos[$key],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}