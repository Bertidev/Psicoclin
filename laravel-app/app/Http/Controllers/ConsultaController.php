<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consultas;
use Inertia\Inertia;

class ConsultaController extends Controller
{
    public function create()
    {
        $psicologos = User::where('role', '2')->get();
        return Inertia::render('Paciente/Agendar', compact('psicologos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
        ]);

        $doctor = User::where('name', $request->name)->where('role', '2')->first();
        if (!$doctor) {
            return redirect()->back()->withErrors(['name' => 'Psicólogo não encontrado.']);
        }

        $consulta = new Consultas();
        $consulta->psicologo_id = $doctor->id;
        $consulta->paciente_id = $request->user()->id;
        $consulta->data = $request->date;

        $consulta->save();

        return redirect()->route('dashboard');
    }

}
