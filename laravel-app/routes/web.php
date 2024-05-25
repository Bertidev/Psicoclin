<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SecretariaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\PsicoController;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\ContactController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'=> Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'foo' => 'bar'
    ]);
});

Route::post('/contact',[ContactController::class,'store'])->name('contact.send');

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

Route::controller(PacienteController::class)->group(function () {
    Route::get('/paciente/dashboard', 'dashboard')->name('paciente.dashboard');
    Route::get('/paciente/historico','historico')->name('paciente.historico');
});

Route::controller(ConsultaController::class)->group(function () {
    Route::get('/agendamento','create')->name('consulta.agendar');
    Route::post('/agendamento/save', 'store')->name('consulta.save');
    Route::delete('/agendamento/cancelar/{id}', 'delete')->name('consulta.delete');
    Route::get('/agendamento/remarcar/{id}','edit')->name('consulta.edit');
    Route::put('/agendamento/{id}','update')->name('consulta.update');
});

Route::controller(PsicoController::class)->group(function () {
    Route::get('/dashboard-ps', 'dashboard')->name('psicologo.dashboard');
    route::get('psicologo/read/{id}','read')->name('psicologo.read');
    Route::put('/psicologo/edit/{id}','update')->name('psicologo.update');
    Route::post('/psicologo/note/{id}','note')->name('note.add');
})->middleware('auth')->name('dashboard');

Route::controller(AdmController::class)->group(function() { 
    Route::get('adm/dashboard','dashboard')->name('adm.dashboard');
    Route::get('adm/create','create')->name('adm.create');
    route::post('adm/save','store')->name('adm.save');
    Route::get('adm/edit/{user}','edit')->name('adm.edit');
    Route::delete('adm/delete/{id},','delete')->name('adm.delete');
    Route::put('/adm/{user}','update')->name('adm.update');

});



require __DIR__ . '/auth.php';
