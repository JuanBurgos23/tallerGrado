<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensajeNotificacion;
use Illuminate\Support\Facades\Auth;

class MensajeUserController extends Controller
{
    public function show($id)
    {
        $mensaje = MensajeNotificacion::findOrFail($id);
        $mensaje->update(['read' => true]);

        return view('pages.mensajesuser.show', compact('mensaje'));
    }

    public function markAsRead($id)
    {
        $mensaje = MensajeNotificacion::findOrFail($id);
        $mensaje->update(['read' => true]);

        return response()->json(['success' => true, 'redirect_url' => route('mensajeUser.show', $mensaje->id)]);
    }

    public function mostrar()
    {
        $user = Auth::user();
                
        $mensajes = MensajeNotificacion::where('id_user', $user->id)->get();

        return view('pages.laravel-examples.user-profile', compact('mensajes'));
    }
}
