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
use App\models\User;
use Illuminate\Support\Facades\Redirect;

class AdmController extends Controller
{
    public function dashboard()
    {
        $psicologos = User::where('role', '=', '2')->get();
        $secretarios = User::where('role', '=', '1')->get();

        return Inertia::render('Admin/Menu',compact('psicologos', 'secretarios'));
    }

    public function create()
    {
        return Inertia::render('Admin/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required','min:8'],
            'role'=>['required','in:1,2'],
            'cep'=>['required', 'string','max:10'],
        ]);

        User::create($validated);

        return redirect(route('adm.dashboard'))->with('confirmation', 'Cadastro realizado com sucesso.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id)->delete();

        return Redirect::to('/adm/dashboard')->with('confirmation', 'Usuário deletado com sucesso.');
    }

    public function edit(User $user)
    {
        return Inertia::render('Admin/Edit',[
            'user'=>$user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated=$request->validate([
            'name'=>'required|max:255',
            'email'=>'required',
            'cep'=>'required|max:9',
            'password'=>'min:8'
        ]);

        $user->update($validated);

        return redirect(route('adm.dashboard'))->with('confirmation', 'Alteração realizada com sucesso.');
    }
}
