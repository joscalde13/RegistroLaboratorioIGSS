<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('examens', function (Blueprint $table) {
            $table->date('fecha_cita')->nullable()->after('fecha');
            $table->enum('estado', ['pendiente', 'toma de muestras', 'proceso', 'finalizado'])->default('pendiente')->after('fecha_cita');
        });
    }

    public function down(): void
    {
        Schema::table('examens', function (Blueprint $table) {
            $table->dropColumn(['fecha_cita', 'estado']);
        });
    }
};
