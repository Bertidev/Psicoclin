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

    public function delete($id)
    {
        $user = User::findOrFail($id)->delete();

        return Redirect::to('/adm/dashboard');
    }

    public function edit($id)
    {

        return Inertia::render('Admin/Edit');
    }
}
