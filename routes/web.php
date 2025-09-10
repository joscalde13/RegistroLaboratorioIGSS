<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamenController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');




Route::get('dashboard', function() {
    return redirect()->route('examens.stats');
})->middleware(['auth', 'verified'])->name('dashboard');






Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    


    Route::get('/examens/create', [ExamenController::class, 'create'])->name('examens.create');
    Route::post('/examens', [ExamenController::class, 'store'])->name('examens.store');
    Route::get('/examens', [ExamenController::class, 'index'])->name('examens.index');
    Route::get('/examens/stats', [ExamenController::class, 'stats'])->name('examens.stats');
    Route::get('/examens/{id}', [ExamenController::class, 'show'])->name('examens.show');
    Route::get('/examens/{id}/edit', [ExamenController::class, 'edit'])->name('examens.edit');
    Route::put('/examens/{id}', [ExamenController::class, 'update'])->name('examens.update');
    Route::delete('/examens/{id}', [ExamenController::class, 'destroy'])->name('examens.destroy');
    Route::get('/examens-export', [ExamenController::class, 'exportCsv'])->name('examens.export');
    Route::get('/examens-export-pdf', [ExamenController::class, 'exportPdf'])->name('examens.exportPdf');

    Route::get('/agenda', [App\Http\Controllers\AgendaController::class, 'index'])->name('agenda.index');
    Route::put('/agenda/{id}/estado', [App\Http\Controllers\AgendaController::class, 'updateEstado'])->name('agenda.updateEstado');
});

require __DIR__.'/auth.php';
