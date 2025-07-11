<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }
    

    public function create(){

        return view('admin.permissions.create');
    }
    public function store(Request $request){

        $validated = $request->validate(['name' => ['required','min:3']]);
        $title = request()->validate([
            'name' => ['required','min:3']
        ]);
        $exists = Permission::where('name', $title)->exists();
        if($exists){

            throw ValidationException::withMessages([
                'name' => 'Questo permesso è già presente'
            ]);
            
        }
        Permission::create($validated);
        return to_route('admin.permissions.index');
    }
    public function edit(Permission $permission){

         $roles = Role::all();
        return view('admin.permissions.edit', compact('permission','roles'));
    }
    public function update(Request $request, Permission $permission){

        $validated = $request->validate(['name' => ['required','min:3']]);
        $permission->update($validated);

        return to_route('admin.permissions.index');
    }
    public function destroy(Permission $permission){

        $permission->delete();

        return back()->with('message','Permission destroyed');
    }
    public function assignRole(Request $request, Permission $permission){

        if($permission->hasRole($request->role)){
            return back()->with('message','Role exists');
        }
        $permission->assignRole($request->role);
        return back()->with('message','Role assigned');
    }
    public function removeRole(Permission $permission, Role $role){

        if($permission->hasRole($role)){
            $permission->removeRole($role);
            return back()->with('message','Role removed');
        }
        return back()->with('message','Role not exists');
    }
}
