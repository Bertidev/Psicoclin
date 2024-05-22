<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Consultas;
use App\models\User;
use Illuminate\Support\Facades\Redirect;

class PacienteController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $consultas = Consultas::with('psicologo')
            ->where('paciente_id', $user->id)
            ->whereDate('data', '>=', now())
            ->get();

        return Inertia::render('Paciente/Menu', ['consultas' => $consultas]);
    }

    public function historico()
    {
        $user = auth()->user();
        $consultas = Consultas::with('psicologo')
            ->where('paciente_id', $user->id)
            ->whereDate('data', '<', now())
            ->get();

        return Inertia::render('Paciente/Historico', ['consultas' => $consultas]);
    }
    
}
