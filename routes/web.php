<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');




Route::get('dashboard', function() {
    return redirect()->route('examens.stats');
})->middleware(['auth', 'verified'])->name('dashboard');






Route::middleware(['auth'])->group(function () {

    Route::get('/examens/export-excel', [ExamenController::class, 'exportExcel'])->name('examens.exportExcel');
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    


    Route::get('/examens/create', [ExamenController::class, 'create'])->name('examens.create');
    Route::post('/examens', [ExamenController::class, 'store'])->name('examens.store');
    Route::get('/examens', [ExamenController::class, 'index'])->name('examens.index');
    Route::get('/examens/stats', [ExamenController::class, 'stats'])->name('examens.stats');
    Route::get('/examens/stats-pdf', [ExamenController::class, 'statsPdf'])->name('examens.statsPdf');
    Route::get('/examens/stats-excel', [ExamenController::class, 'statsExcel'])->name('examens.statsExcel');
    Route::get('/examens/{id}', [ExamenController::class, 'show'])->name('examens.show');
    Route::get('/examens/{id}/edit', [ExamenController::class, 'edit'])->name('examens.edit');
    Route::put('/examens/{id}', [ExamenController::class, 'update'])->name('examens.update');
    Route::delete('/examens/{id}', [ExamenController::class, 'destroy'])->name('examens.destroy');
    Route::get('/examens-export', [ExamenController::class, 'exportCsv'])->name('examens.export');

    Route::get('/examens-export-pdf', [ExamenController::class, 'exportPdf'])->name('examens.exportPdf');


    // Historial de exámenes por paciente (número de afiliación)
    Route::get('/examens/historial/{numero_afiliacion}', [ExamenController::class, 'historialPaciente'])->name('examens.historial');

    // Reportes por año y mes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::get('/reportes/{anio}', [ReporteController::class, 'meses'])->name('reportes.meses');
    Route::get('/reportes/{anio}/{mes}', [ReporteController::class, 'listado'])->name('reportes.listado');

    Route::get('/agenda', [App\Http\Controllers\AgendaController::class, 'index'])->name('agenda.index');
    Route::put('/agenda/{id}/estado', [App\Http\Controllers\AgendaController::class, 'updateEstado'])->name('agenda.updateEstado');
});

require __DIR__.'/auth.php';
