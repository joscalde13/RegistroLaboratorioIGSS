<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Examen;

class ActualizarCorrelativosExamens extends Command
{
    protected $signature = 'examens:actualizar-correlativos';
    protected $description = 'Actualiza los correlativos mensuales de los registros existentes en la tabla examens';

    public function handle()
    {
        $registros = Examen::orderBy('fecha')->get();
        $meses = [];
        foreach ($registros as $examen) {
            $mes = date('Y-m', strtotime($examen->fecha));
            if (!isset($meses[$mes])) {
                $meses[$mes] = 1;
            } else {
                $meses[$mes]++;
            }
            $examen->correlativo = $meses[$mes];
            $examen->save();
        }
        $this->info('Correlativos actualizados correctamente.');
    }
}
