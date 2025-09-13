<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->id(); 
            $table->integer('correlativo'); // correlativo mensual
$table->date('fecha');
            $table->string('numero_afiliacion');
            $table->string('nombre');
            $table->string('apellido');
            $table->enum('sexo', ['Masculino', 'Femenino']);
            $table->enum('calidad', ['AF', 'BH', 'Pen', 'BE', 'NA']);
            $table->integer('edad');
            $table->enum('unidad', ['Patulul', 'Pochuta', 'Santa Barbara', 'San Lucas Tolimán', 'Licores de Guatemala', 'Guatemala', 'Mazatenango']);
            $table->enum('area', ['Consulta Externa', 'Encamamiento', 'Emergencia', 'Clínica de Personal']);
            $table->enum('programa', ['Enfermedad Común', 'Gineco-Obstetricia', 'Pediatría', 'Traumatología y Ortopedia', 'Maternidad']);
            $table->enum('seccion', ['Hematología', 'Coprología', 'Urología', 'Bioquímica', 'Inmunología', 'Serología', 'Microbiología', 'Especiales', 'Coagulación']);
            $table->string('perfil'); // Ej: Pediatrico, Diabetes, Renal, etc.
            $table->text('pruebas'); // Guardar pruebas asociadas al perfil (JSON o texto)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};