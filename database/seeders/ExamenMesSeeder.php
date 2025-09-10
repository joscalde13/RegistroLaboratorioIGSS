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
        // No truncar la tabla, así los exámenes previos siguen ahí

        // Agosto: 3 exámenes con nombres reales y diferentes estados
        $examenesAgosto = [
            [
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
                'fecha' => Carbon::create(2025, 8, 10),
                'fecha_cita' => Carbon::create(2025, 8, 15),
                'estado' => 'pendiente',
                'correlativo' => 1,
            ],
            [
                'numero_afiliacion' => 'IGSS-1002',
                'nombre' => 'María Fernanda',
                'apellido' => 'Gómez',
                'sexo' => 'Femenino',
                'calidad' => 'BH',
                'edad' => 34,
                'unidad' => 'Guatemala',
                'area' => 'Emergencia',
                'programa' => 'Gineco-Obstetricia',
                'seccion' => 'Bioquímica',
                'perfil' => 'Diabetes',
                'pruebas' => json_encode(['Glucosa', 'Hemoglobina']),
                'fecha' => Carbon::create(2025, 8, 12),
                'fecha_cita' => Carbon::create(2025, 8, 18),
                'estado' => 'toma de muestras',
                'correlativo' => 2,
            ],
            [
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
                'fecha' => Carbon::create(2025, 8, 14),
                'fecha_cita' => Carbon::create(2025, 8, 20),
                'estado' => 'finalizado',
                'correlativo' => 3,
            ],
        ];
        foreach ($examenesAgosto as $examen) {
            Examen::create($examen);
        }

        // Septiembre: 2 exámenes
        $calidades = ['AF', 'BH', 'Pen', 'BE', 'NA'];
        $fechaSeptiembre = Carbon::create(2025, 9, 5);
        for ($i = 1; $i <= 2; $i++) {
            Examen::create([
                'numero_afiliacion' => 'SEP-00' . $i,
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
                'correlativo' => $i,
            ]);
        }

        // Octubre: 4 exámenes
        $fechaOctubre = Carbon::create(2025, 10, 2);
        for ($i = 1; $i <= 4; $i++) {
            Examen::create([
                'numero_afiliacion' => 'OCT-00' . $i,
                'nombre' => 'Paciente Octubre ' . $i,
                'apellido' => 'Apellido',
                'sexo' => 'Masculino',
                'calidad' => $calidades[($i+2)%count($calidades)],
                'edad' => 40,
                'unidad' => 'Santa Barbara',
                'area' => 'Emergencia',
                'programa' => 'Pediatría',
                'seccion' => 'Urología',
                'perfil' => 'Perfil',
                'pruebas' => json_encode(['Prueba3']),
                'fecha' => $fechaOctubre,
                'correlativo' => $i,
            ]);
        }

        // Noviembre: 2 exámenes
        $fechaNoviembre = Carbon::create(2025, 11, 15);
        for ($i = 1; $i <= 2; $i++) {
            Examen::create([
                'numero_afiliacion' => 'NOV-00' . $i,
                'nombre' => 'Paciente Noviembre ' . $i,
                'apellido' => 'Apellido',
                'sexo' => 'Femenino',
                'calidad' => $calidades[($i+3)%count($calidades)],
                'edad' => 28,
                'unidad' => 'San Lucas Tolimán',
                'area' => 'Clínica de Personal',
                'programa' => 'Traumatología y Ortopedia',
                'seccion' => 'Bioquímica',
                'perfil' => 'Perfil',
                'pruebas' => json_encode(['Prueba4']),
                'fecha' => $fechaNoviembre,
                'correlativo' => $i,
            ]);
        }
    }
}