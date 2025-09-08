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

        // Agosto: 3 exámenes
        $fechaAgosto = Carbon::create(2025, 8, 10);
        $calidades = ['AF', 'BH', 'Pen', 'BE', 'NA'];
        for ($i = 1; $i <= 3; $i++) {
            Examen::create([
                'numero_afiliacion' => 'AUG-00' . $i,
                'nombre' => 'Paciente Agosto ' . $i,
                'apellido' => 'Apellido',
                'sexo' => 'Masculino',
                'calidad' => $calidades[($i-1)%count($calidades)],
                'edad' => 30,
                'unidad' => 'Patulul',
                'area' => 'Consulta Externa',
                'programa' => 'Enfermedad Común',
                'seccion' => 'Hematología',
                'perfil' => 'Perfil',
                'pruebas' => json_encode(['Prueba1']),
                'fecha' => $fechaAgosto,
                'correlativo' => $i,
            ]);
        }

        // Septiembre: 2 exámenes
        $fechaSeptiembre = Carbon::create(2025, 9, 5);
        for ($i = 1; $i <= 2; $i++) {
            Examen::create([
                'numero_afiliacion' => 'SEP-00' . $i,
                'nombre' => 'Paciente Septiembre ' . $i,
                'apellido' => 'Apellido',
                'sexo' => 'Femenino',
                'calidad' => $calidades[($i+1)%count($calidades)],
                'edad' => 25,
                'unidad' => 'Pochuta',
                'area' => 'Encamamiento',
                'programa' => 'Gineco-Obstetricia',
                'seccion' => 'Coprología',
                'perfil' => 'Perfil',
                'pruebas' => json_encode(['Prueba2']),
                'fecha' => $fechaSeptiembre,
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