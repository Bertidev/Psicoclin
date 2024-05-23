<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use App\Mail\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        Mail::to('contato@psicoclin.com','Psicoclin')->send(new Contact([
            'fromName'=> $request->input('nome'),
            'fromEmail'=> $request->input('email'),
            'subject'=> $request->input('assunto'),
            'message'=> $request->input('mensagem'),
        ]));

        return redirect()->back()->with('confirmation', 'Email enviado com sucesso! Entraremos em contato em breve.');
    }
}