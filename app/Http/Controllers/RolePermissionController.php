<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::all();

        return view('/modulos/gestionar-usuarios', compact('roles', 'permissions', 'users'));
    }

    public function assignRole(Request $request, User $user)
    {
        $user->assignRole($request->role);
        return back()->with('success', 'Role assigned successfully');
    }

    public function removeRole(User $user, Role $role)
    {
        $user->removeRole($role);
        return back()->with('success', 'Role removed successfully');
    }

    public function assignPermission(Request $request, User $user)
    {
        $user->givePermissionTo($request->permission);
        return back()->with('success', 'Permission assigned successfully');
    }

    public function removePermission(User $user, Permission $permission)
    {
        $user->revokePermissionTo($permission);
        return back()->with('success', 'Permission removed successfully');
    }
}
