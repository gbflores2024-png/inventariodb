<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('asignar.index', compact('users'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('asignar.create', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        $user->syncRoles([$role->name]);

        return redirect()
            ->route('asignar.index')
            ->with('success', 'Rol asignado correctamente.');
    }
}