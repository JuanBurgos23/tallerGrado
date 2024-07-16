<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Verificar y crear el rol 'admin' si no existe
        if (!Role::where('name', 'admin')->exists()) {
            $role1 = Role::create(['name' => 'admin']);
        } else {
            $role1 = Role::where('name', 'admin')->first();
        }

        // Verificar y crear el rol 'empleado' si no existe
        if (!Role::where('name', 'empleado')->exists()) {
            $role2 = Role::create(['name' => 'empleado']);
        } else {
            $role2 = Role::where('name', 'empleado')->first();
        }

        // Verificar y crear el rol 'usuario' si no existe
        if (!Role::where('name', 'usuario')->exists()) {
            $role3 = Role::create(['name' => 'usuario']);
        } else {
            $role3 = Role::where('name', 'usuario')->first();
        }

        // Asignar el rol 'admin' al primer usuario si existe
        $user = User::find(1);
        if ($user) {
            $user->assignRole($role1);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
    }
};
