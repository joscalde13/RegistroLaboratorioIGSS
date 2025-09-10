<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'fecha_cita',
        'estado',
        'correlativo',
        'numero_afiliacion',
        'nombre',
        'apellido',
        'sexo',
        'calidad',
        'edad',
        'unidad',
        'area',
        'programa',
        'seccion',
        'perfil',
        'pruebas',
    ];
}