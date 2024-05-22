<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $sent = Mail::to('lucasvalber2@gmail.com','Lucas')->send(new Contact([
            'fromName'=> $request->input('nome'),
            'fromEmail'=> $request->input('email'),
            'subject'=> $request->input('assunto'),
            'message'=> $request->input('mensagem'),
        ]));
        var_dump('email sent', $sent);
    }
}
