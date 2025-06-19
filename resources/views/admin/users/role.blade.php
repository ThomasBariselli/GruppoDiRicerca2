@extends('layouts.admin')
    <title>
        Admin Panel - Gruppo Di Ricerca
    </title>
    
  <div class="container-fluid" style="padding-top:5%;padding-left:25%" >
        
        <form class="py-3" style="padding-left:25%;width:60%">
            <h4>User</h4>
            <div class="row mb-3 pt-4">
                <div class="col-mb-3">
                  <input type="name" class="form-control" name="name" id="name" value="{{ $user->firstname }}{{ $user->lastname }}" disabled>
                  <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" disabled>
                </div>
            </div>
        </form>
        <div class="container-fluid" style="padding-left:25%">
        <hr style="width:47%">
          <h4>Roles</h4>
          <div class="flex space-x-2 mt-4 pt-2">
            @if($user->roles)
              @foreach($user->roles as $user_role)
                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white" method="POST"  action="{{ route('admin.users.roles.remove', [$user->id,$user_role->id]) }}" onsubmit="return confirm('Are you sure?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">{{ $user_role->name }}</button>
                </form>
              @endforeach
            @endif
          </div>
          <form method="POST" action="{{route('admin.users.roles', $user->id)}}" class="py-3" style="width:46%;padding-left:1.5%;">
            @csrf
              <div class="row mb-3" >
                  <label for="role" class="col-sm-2 col-form-label">Roles</label>
                  <select data-mdb-select-init id="role" name="role" autocomplete="role-name" class="mt-1 block w-full py-2 px-3" style="border-radius: 5px;">
                    @foreach($roles as $role)
                      <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                  </select>
                  @error('role')
                      <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                  @enderror
              </div>
              <div class="container-fluid pb-5">
                  <button type="submit" class="btn btn-success" style="float:right">Assign</button>
              </div>
          </form>
        </div>
        <div class="container-fluid" style="padding-left:25%;">
          <hr style="width:47%">
            <h4>Permissions</h4>
            <div class="flex space-x-2 mt-4 pt-2">
              @if($user->permissions)
                @foreach($user->permissions as $user_permission)
                  <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white" method="POST"  action="{{ route('admin.users.permissions.revoke', [$user->id,$user_permission->id]) }}" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ $user_permission->name }}</button>
                  </form>
                @endforeach
              @endif
            </div>
            <form method="POST" action="{{route('admin.users.permissions', $user->id)}}" class="py-3" style="width:46%;padding-left:1.5%;">
              @csrf
                <div class="row mb-3" >
                    <label for="permission" class="col-sm-2 col-form-label">Permission</label>
                    <select data-mdb-select-init id="permission" name="permission" autocomplete="permission-name" class="mt-1 block w-full py-2 px-3" style="border-radius: 5px;">
                      @foreach($permissions as $permission)
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                      @endforeach
                    </select>
                    @error('permission')
                        <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="container-fluid pb-5">
                    <button type="submit" class="btn btn-success" style="float:right">Assign</button>
                </div>
            </form>
          </div>
      </div>
  
  
