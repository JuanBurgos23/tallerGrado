<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use App\Models\oficial;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MensajeNotificacion;

class ContactoController extends Controller
{
    public function index()
    {
        $usuarios = User::where('email', 'like', '%@felcc.com')->get();
        return view("pages.contacto.email_admin", compact('usuarios'));
    }
    public function correoOficial()
    {
        $oficiales = oficial::all();
        return view("pages.contacto.correoOficiales", compact('oficiales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asunto' => 'required',
            'nombre' => 'required',
            'correo_remitente' => 'required|email',
            'correo_destino' => 'required|array',
            'correo_destino.*' => 'email',
            'mensaje' => 'required',
        ]);

        $correo = new ContactoMailable($request->all());
        // Determina el mailer a utilizar
        // Iterar sobre los correos de destino y enviar el correo con el mailer adecuado
        foreach ($request->correo_destino as $destino) {
            if (str_contains($destino, 'felcc.com')) {
                Mail::mailer('smtp_local')->to($destino)->send($correo);
            } else {
                Mail::mailer('smtp')->to($destino)->send($correo);
            }


            $user = User::where('email', $destino)->first();
            if ($user) {
                MensajeNotificacion::create([
                    'id_user' => $user->id,
                    'type' => 'message',
                    'correo_remitente' => "{$request->correo_remitente}",
                    'data' => "{$request->nombre}",
                    'asunto' => "{$request->asunto}",
                    'mensaje' => "$request->mensaje",
                    'read' => false,
                ]);
            }
        }

        return redirect()->route('email_admin')->with('info', 'Tu mensaje ha sido enviado correctamente!!');

    }
}
