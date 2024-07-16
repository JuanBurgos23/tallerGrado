<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\denuncia;

class NotificationController extends Controller
{
    public function index()
    {
        // Obtener todas las notificaciones del usuario autenticado
        $notifications = auth()->user()->notifications;

        // Filtrar las notificaciones para mostrar solo las denuncias en estado 'pendiente'
        $filteredNotifications = $notifications->filter(function ($notification) {
            $denunciaId = $notification->data['denuncia_id'] ?? null;
            if ($denunciaId) {
                $denuncia = denuncia::find($denunciaId);
                return $denuncia && $denuncia->estado === 'Pendiente';
            }
            return false;
        });

        return view('pages.notifications', ['filteredNotifications' => $filteredNotifications]);
    }

    public function show($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->markAsRead();
        return redirect()->route('mostrarDenunciaNot', $notification->data['denuncia_id']);
    }
}
