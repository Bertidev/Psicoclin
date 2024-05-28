<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Consultas;
use Illuminate\Support\Facades\Redirect;

class SecretariaController extends Controller
{
    public function dashboard()
    {
        $pacientes = User::where('role', '=', '0')->get();
        $consultasHoje = Consultas::with(['paciente', 'psicologo'])
            ->whereDate('data', '=', now()->toDateString())
            ->get();

        return Inertia::render('Secretaria/Menu', compact('pacientes', 'consultasHoje'));
    }

    public function create()
    {
        return Inertia::render('Secretaria/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'min:8'],
            'cep' => ['required', 'string', 'max:10'],
        ]);

        User::create($validated);

        return redirect(route('secretaria.dashboard'))->with('confirmation', 'Paciente cadastrado com sucesso.');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();

        return Redirect::to('/secretaria/dashboard')->with('confirmation', 'Paciente deletado com sucesso');
    }

    public function edit(User $user)
    {
        return Inertia::render('Secretaria/Edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'cep' => 'required|max:9',
            'password' => 'min:8'
        ]);

        $user->update($validated);

        return redirect(route('secretaria.dashboard'))->with('confirmation', 'Alteração realizada com sucesso.');
    }
}
