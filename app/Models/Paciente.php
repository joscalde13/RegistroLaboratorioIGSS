<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'numero_afiliacion',
        'nombre',
        'apellido',
        'sexo',
        'edad',
        'created_at',
        'updated_at',
    ];

    public function examens()
    {
        return $this->hasMany(Examen::class, 'numero_afiliacion', 'numero_afiliacion');
    }
}
