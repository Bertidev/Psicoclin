<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Consultas;
use App\Models\Notas;
use Barryvdh\DomPDF\Facade\Pdf;

class PsicoController extends Controller
{
    public function dashboard(Request $request)
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

        $pacientes = $consultas->map(function($consulta) {
            return $consulta->paciente;
        })->unique('id');

        if ($request->expectsJson()) {
            return response()->json([
                'consultas' => $consultas,
                'consultas_hoje' => $consultas_hoje,
                'pacientes' => $pacientes,
            ]);
        }

        return Inertia::render('Psicologo/Menu', [
            'consultas' => $consultas, 
            'consultas_hoje' => $consultas_hoje,
            'pacientes' => $pacientes,
        ]);
    }

    public function read($id)
    {
        $consulta = Consultas::with('paciente')->findOrFail($id);
        $paciente = $consulta->paciente;
        $notas = Notas::where('consulta', $id)->get();

        return Inertia::render('Psicologo/Read', [
            'consulta' => $consulta,
            'paciente' => $paciente,
            'notas' => $notas,
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

        return redirect()->back()->with('confirmation', 'Informações do paciente atualizadas com sucesso.');
    }

    public function note(Request $request, $id)
    {
        $request->validate([
            'notas' => 'required|string|max:1000',
        ]);

        $nota = new Notas();
        $nota->psicologo = $request->user()->id;
        $nota->consulta = $id;
        $nota->nota = $request->notas;
        $nota->save();

        return redirect()->back()->with('confirmation', 'Nota adicionada com sucesso.');
    }

    public function deleteNote($id)
    {
        $nota = Notas::findOrFail($id);
        $nota->delete();

        return redirect()->back()->with('confirmation', 'Nota apagada com sucesso.');
    }

    public function updateNote(Request $request, $id)
    {
        $request->validate([
            'nota' => 'required|string|max:1000',
        ]);

        $nota = Notas::findOrFail($id);
        $nota->update([
            'nota' => $request->nota,
        ]);

        return redirect()->back()->with('confirmation', 'Nota atualizada com sucesso.');
    }
    
    public function editpacient($id)
    {
        $paciente = User::findOrFail($id);
        $consultas = Consultas::where('paciente_id', $id)->pluck('id');
        $notas = Notas::whereIn('consulta', $consultas)->get();

        return Inertia::render('Psicologo/Edit', [
            'paciente' => $paciente,
            'notas' => $notas,
        ]);
    }

    public function gerarEncaminhamento(Request $request ,$id)
    {
        $paciente = User::findOrFail($id);
        $texto = $request->input('texto');

        $pdf = PDF::loadView('encaminhamento', compact('paciente', 'texto'));
        $filename = 'encaminhamento.pdf';
        $pdf->save(public_path($filename));

        return response()->json(['url' => asset($filename)]);
    }

    public function gerarAtestado(Request $request, $id)
    {
        $paciente = User::findOrFail($id);
        $texto = $request->input('texto');

        $pdf = PDF::loadView('atestado', ['paciente' => $paciente, 'texto' => $texto]);
        $filename = 'atestado.pdf';
        $pdf->save(public_path($filename));

        return response()->json(['url' => asset($filename)]);
    }


}