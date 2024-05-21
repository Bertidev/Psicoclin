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

class ConsultaController extends Controller
{
    public function create()
    {
        return Inertia::render('Paciente/Agendar');
    }
}
