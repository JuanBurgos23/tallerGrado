<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use App\Mail\BackupNotification;

class BackupController extends Controller
{
    public function index()
    {
        return view('crearBackup.backup');
    }

    public function createBackup()
    {
        try {
            Artisan::call('backup:run');

            $messageContent = 'Backup created successfully.';

            // Enviar notificación usando el servidor local
            Config::set('mail.mailers.smtp_local', [
                'transport' => 'smtp',
                'host' => env('MAIL_HOST_LOCAL'),
                'port' => env('MAIL_PORT_LOCAL'),
                'encryption' => env('MAIL_ENCRYPTION_LOCAL'),
                'username' => env('MAIL_USERNAME_LOCAL'),
                'password' => env('MAIL_PASSWORD_LOCAL'),
                'timeout' => null,
                'verify_peer' => false,
            ]);
            Config::set('mail.from.address', env('MAIL_FROM_ADDRESS_LOCAL'));
            Config::set('mail.from.name', env('MAIL_FROM_NAME_LOCAL'));

            Mail::mailer('smtp_local')->raw($messageContent, function ($message) {
                $message->to(env('MAIL_NOTIFICATION_TO_LOCAL'))
                    ->subject('Backup Notification');
            });

            // Enviar notificación usando Mailtrap
            Config::set('mail.mailers.smtp', [
                'transport' => 'smtp',
                'host' => env('MAIL_HOST'),
                'port' => env('MAIL_PORT'),
                'encryption' => env('MAIL_ENCRYPTION'),
                'username' => env('MAIL_USERNAME'),
                'password' => env('MAIL_PASSWORD'),
                'timeout' => null,
                'verify_peer' => false,
            ]);
            Config::set('mail.from.address', env('MAIL_FROM_ADDRESS'));
            Config::set('mail.from.name', env('MAIL_FROM_NAME'));

            Mail::mailer('smtp')->raw($messageContent, function ($message) {
                $message->to(env('MAIL_NOTIFICATION_TO_MAILTRAP'))
                    ->subject('Backup Notification');
            });

            return redirect()->back()->with('success', 'Copia de seguridad creada correctamente y notificaciones enviadas.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'No se pudo crear la copia de seguridad: ' . $e->getMessage());
        }

    }
}
