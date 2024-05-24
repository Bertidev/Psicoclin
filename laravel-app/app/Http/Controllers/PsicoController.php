<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Consultas;

class PsicoController extends Controller
{
    public function dashboard()
    {
        
        $psicologoId = auth()->user()->id; 

        $consultas = Consultas::with('paciente') 
            ->where('psicologo_id', $psicologoId)
            ->whereDate('data', '>=',now())
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
}
