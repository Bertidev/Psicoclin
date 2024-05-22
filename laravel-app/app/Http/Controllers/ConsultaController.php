<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consultas;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

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
            'date' => 'required|date|after_or_equal:today',
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

    public function delete($id)
    {
        $consulta = Consultas::findOrFail($id)->delete();

        return redirect::to('/paciente/dashboard');
    }

    public function edit($id)
    {   
        $consulta = Consultas::findOrFail($id);
        $psicologos = User::where('role', '2')->get();

        return Inertia::render('Paciente/Edit', [
            'consulta' => $consulta,
            'psicologos' => $psicologos
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'psicologo_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
        ]);

        $consulta = Consultas::findOrFail($id);
        $consulta->psicologo_id = $request->psicologo_id;
        $consulta->data = $request->date;

        $consulta->save();

        return redirect()->route('paciente.dashboard');
    }
}
