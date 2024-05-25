<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Consultas;
use App\Models\Notas;

class PsicoController extends Controller
{
    public function dashboard()
    {
        $psicologoId = auth()->user()->id; 

        $consultas = Consultas::with('paciente')
            ->where('psicologo_id', $psicologoId)
            ->whereDate('data', '>=', now())
            ->get();

        $consultas_hoje = Consultas::with('paciente')
            ->where('psicologo_id', $psicologoId)
            ->whereDate('data', '=', now())
            ->get();

        return Inertia::render('Psicologo/Menu', [
            'consultas' => $consultas, 
            'consultas_hoje' => $consultas_hoje,
        ]);
    }

    public function read($id)
    {
        $consulta = Consultas::with('paciente')->findOrFail($id);
        $paciente = $consulta->paciente; 

        return Inertia::render('Psicologo/Read', [
            'consulta' => $consulta,
            'paciente' => $paciente,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'cep' => 'required|string|max:10',
        ]);

        $paciente = User::findOrFail($id);
        $paciente->update($request->only('name', 'email', 'cep'));

        return redirect()->back()->with('success', 'Informações do paciente atualizadas com sucesso.');
    }

    public function note(Request $request, $id)
    {
        $request->validate([
            'notas' => 'required|string|max:1000',
        ]);

        $nota = new Notas();
        $nota->psicologo = $request->user()->id;
        $nota->paciente = $id;
        $nota->nota = $request->notas;
        $nota->save();

        return redirect()->back()->with('success', 'Nota adicionada com sucesso.');
    }

}
