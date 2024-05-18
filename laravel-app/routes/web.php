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
    Route::get('secretaria/create','create')->name('secretaria.create');
    Route::post('secretaria/save','store')->name('secretaria.save');
    Route::get('secretaria/edit/{user}','edit')->name('secretaria.edit');
    Route::delete('secretaria/delete/{id}','delete')->name('secretaria.delete');
    Route::put('/secretaria/{user}','update')->name('secretaria.update');
});

Route::controller(PsicoController::class)->group(function () {
    Route::get('/dashboard-ps', 'dashboard')->name('psicologo.dashboard');
})->middleware('auth')->name('dashboard');

Route::controller(AdmController::class)->group(function () {
    Route::get('adm/dashboard', 'dashboard')->name('adm.dashboard');
});



require __DIR__ . '/auth.php';
