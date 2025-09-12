<?php
namespace App\Exports;

use App\Models\Examen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamensExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Examen::select('correlativo', 'fecha', 'numero_afiliacion', 'nombre', 'apellido', 'sexo', 'calidad', 'edad', 'unidad', 'area', 'programa', 'seccion', 'perfil', 'pruebas', 'estado')->get();
    }

    public function headings(): array
    {
        return [
            'Correlativo', 'Fecha', 'N° Afiliación', 'Nombre', 'Apellido', 'Sexo', 'Calidad', 'Edad', 'Unidad', 'Área', 'Programa', 'Sección', 'Perfil', 'Pruebas', 'Estado'
        ];
    }
}
