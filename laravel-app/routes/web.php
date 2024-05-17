<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\PsicoController;
use App\Http\Controllers\AdmController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'foo' => 'bar'
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::controller(SecretariaController::class)->group(function () {
    Route::get('secretaria/dashboard', 'dashboard')->name('secretaria.dashboard');
    Route::get('secretaria/save','save')->name('secretaria.save');
    Route::get('secretaria/createpaciente','create')->name('secretaria.create');
    Route::get('secretaria/edit/{id}','edit')->name('secretaria.edit');
    Route::put('secretaria/update/{id}','update')->name('secretaria.update');
    Route::get('secretaria/delete/{id}','delete')->name('secretaria.delete');
});

Route::controller(PsicoController::class)->group(function () {
    Route::get('/dashboard-ps', 'dashboard')->name('psicologo.dashboard');
})->middleware('auth')->name('dashboard');

Route::controller(AdmController::class)->group(function () {
    Route::get('adm/dashboard', 'dashboard')->name('adm.dashboard');
});



require __DIR__ . '/auth.php';
