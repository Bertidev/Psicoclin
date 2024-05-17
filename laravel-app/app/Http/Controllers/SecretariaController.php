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
        return Inertia::render('Secretaria/Menu');
    }
    public function save(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cep'=>['required', 'string','max:10']
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cep'=>$request->cep,
        ]);
        event(new Registered($user));

        return Inertia::render('Secretaria/create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('Secretaria/edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $name =  $request->name;
        $email = $request->email;
        $cep = $request->cep;

        $user->name = $name;
        $user->email = $email;
        $user->cep = $cep;

        $data = $user->save();
        return Inertia::render('Secretiria/Menu');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id)->delete();
        if ($user) 
        {
            session()->flash('success', 'user deleted Successfully');
            return Inertia::render('Secretaria/Menu');
        }
        else
        {
            session()->flash('error', 'user not deleted Successfully');
            return Inertia::render('Secretaria/Menu');
        }
    }
}
