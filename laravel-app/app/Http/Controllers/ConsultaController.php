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

    public function notify($id)
    {
        try {
            $consulta = Consultas::findOrFail($id);
            $consulta->notificado = true;
            $consulta->save();

            return response()->json(['success' => 'Psicóloga notificada com sucesso.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao notificar a psicóloga: ' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'psicologo_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time'=> 'required|date_format:H:i|before:18:31|after:7:59'
        ]);

        $doctor = User::where('id', $request->psicologo_id)->where('role', '2')->first();
        if (!$doctor) {
            return redirect()->back()->withErrors(['name' => 'Psicólogo não encontrado.']);
        }

        
        $existingConsultation = Consultas::where('psicologo_id', $doctor->id)
            ->where('data', $request->date)
            ->where('hora', $request->time)
            ->first();

        if ($existingConsultation) {
            return redirect()->back()->withErrors(['time' => 'O psicólogo já possui uma consulta agendada neste horário.']);
        }

        $consulta = new Consultas();
        $consulta->psicologo_id = $doctor->id;
        $consulta->paciente_id = $request->user()->id;
        $consulta->data = $request->date;
        $consulta->hora = $request->time;

        $consulta->save();

        return redirect()->route('dashboard')->with('confirmation', 'Consulta agendada com sucesso.');
    }

    public function delete($id)
    {
        $consulta = Consultas::findOrFail($id)->delete();

        return redirect::to('/paciente/dashboard')->with('confirmation', 'Consulta cancelada com sucesso.');
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
            'time'=> 'required|date_format:H:i|before:18:31|after:7:59'
        ]);

        $consulta = Consultas::findOrFail($id);

        
        $existingConsultation = Consultas::where('psicologo_id', $request->psicologo_id)
            ->where('data', $request->date)
            ->where('hora', $request->time)
            ->where('id', '!=', $id)
            ->first();

        if ($existingConsultation) {
            return redirect()->back()->withErrors(['time' => 'O psicólogo já possui uma consulta agendada neste horário.']);
        }

        $consulta->psicologo_id = $request->psicologo_id;
        $consulta->hora = $request->time;
        $consulta->data = $request->date;

        $consulta->save();

        return redirect()->route('paciente.dashboard')->with('confirmation', 'Consulta remarcada com sucesso');
    }
}
