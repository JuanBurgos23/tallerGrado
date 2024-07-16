<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role; // Importa el modelo Role
use Spatie\Permission\Traits\HasRoles; // Importa el trait HasRoles
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5|max:255',
        ]);

        $user = User::create($attributes);

        // Obtener el rol "usuario" por su identificador
        $roleId = Role::where('name', 'usuario')->value('id');
        // Asignar el rol "usuario" al nuevo usuario si se encontró el ID del rol
        if ($roleId) {
            $user->assignRole($roleId);
        }
        //autentica al usuario recien creado
        auth()->login($user);

        // Crear el usuario en el servidor de correo
        $this->createMailUser($attributes['name'], $attributes['password']);

        return redirect('denuncia');
    }


    //crear usuario en servidor de correo
    protected function createMailUser($username, $password)
    {
        $mailServer = 'correo.felcc.com'; // Dirección IP o dominio del servidor de correo
        $mailUser = 'root'; // Usuario con permisos sudo para ejecutar comandos
        $keyFile = '/root/.ssh/felcc'; // Ruta a tu clave privada SSH
        $knownHostsFile = '/var/www/.ssh/known_hosts'; // Ruta al archivo known_hosts de apache

        // Comando para crear el usuario en el servidor de correo
        $command = "ssh -o UserKnownHostsFile=$knownHostsFile -i $keyFile $mailUser@$mailServer 'sudo useradd --create-home --shell /bin/bash $username && echo \"$username:$password\" | sudo chpasswd' 2>&1";

        // Ejecutar el comando y capturar la salida
        exec($command, $output, $exitCode);

        // Verificar el resultado
        if ($exitCode !== 0) {
            // Error al ejecutar el comando
            $errorMessage = implode("\n", $output);
            \Log::error("Failed to create mail user $username on $mailServer. Error: $errorMessage");
        } else {
            // Éxito al crear el usuario
            \Log::info("Mail user $username created successfully on $mailServer.");
        }
    }

    public function index()
    {
        // Paginamos los usuarios, 10 por página, ordenados en forma descendente por la columna 'created_at'
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.laravel-examples.user-management', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::Find($id);
        $user->delete();
        return view('pages.laravel-examples.user-management');
    }

}