<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendTestEmail()
    {
        $details = [
            'title' => 'Correo de prueba de Laravel',
            'body' => 'Este es un correo de prueba enviado desde Laravel.'
        ];

        Mail::to('juan@felcc.com')->send(new \App\Mail\TestMail($details));
        return 'Correo enviado';
    }
}
