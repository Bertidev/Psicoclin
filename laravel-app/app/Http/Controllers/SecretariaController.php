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
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SecretariaController extends Controller
{
    public function dashboard()
    {
        $pacientes = User::where('role','=','0')->get();

        return Inertia::render('Secretaria/Menu',compact('pacientes'));
    }

    public function create()
    {
        return Inertia::render('Secretaria/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required','min:8'],
            'cep'=>['required', 'string','max:10'],
        ]);

        User::create($validated);

        return redirect(route('secretaria.dashboard'));
    }

    public function delete($id)
    {
        $user = User::findOrFail($id)->delete();
        
        return redirect::to('/secretaria/dashboard');
    }

    public function edit(User $user)
    {
        return Inertia::render('Secretaria/Edit',[
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

        return redirect(route('secretaria.dashboard'));
    }

}
