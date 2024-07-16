<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{


    public function showAssignRoleForm()
    {
       $users = User::where('email', 'like', '%@felcc.com')->get();
        $roles = Role::all();
        return view('pages.asignar_rol', compact('users', 'roles'));
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::find($request->input('user_id'));
        $role = Role::find($request->input('role_id'));

        // Elimina todos los roles anteriores y asigna el nuevo rol
        $user->syncRoles([$role]);

        return redirect()->back()->with('success', 'Role updated successfully.');
    }
}