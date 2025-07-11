<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::whereNotIn('name', ['admin'])->get();//non posso modificare admin altrimenti non accedo più e quindi non lo faccio visualizzare
        return view('admin.roles.index', compact('roles'));
    }

    public function create(){

        return view('admin.roles.create');
    }
    public function store(Request $request){

        $validated = $request->validate(['name' => ['required','min:3']]);
        $title = request()->validate([
            'name' => ['required','min:3']
        ]);
        $exists = Role::where('name', $title)->exists();
        if($exists){

            throw ValidationException::withMessages([
                'name' => 'Questo permesso è già presente'
            ]);
            
        }
        Role::create($validated);
        return to_route('admin.roles.index');
    }

    public function edit(Role $role){

        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));
    }
    public function update(Request $request, Role $role){

        $validated = $request->validate(['name' => ['required','min:3']]);
        $role->update($validated);

        return to_route('admin.roles.index');
    }
    public function destroy(Role $role){

        $role->delete();

        return back()->with('message','Role destroyed');
    }
    public function givePermission(Request $request, Role $role){

        if($role->hasPermissionTo($request->permission)){
            return back()->with('message','Permission exists');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message','Permission added');
    }
    public function revokePermission(Role $role, Permission $permission){

        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message','Permission revoked');
        }
        return back()->with('message','Permission not exists');
    }
}
