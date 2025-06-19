@extends('layouts.admin')
    <title>
        Admin Panel - Gruppo Di Ricerca
    </title>
    
  <div class="container-fluid" style="padding-top:5%;padding-left:25%" >
        <form method="POST" action="{{route('admin.roles.update', $role->id)}}" class="py-3" style="padding-left:25%;width:60%">
            @csrf
            @method('PUT')

            <div class="row mb-3" >
                <label for="name" class="col-sm-2 col-form-label">Role name</label>
                <div class="col-mb-3">
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome" value="{{ $role->name }}" required>
                </div>

                @error('name')
                    <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right" >Update</button>
            </div>
        </form>
        <div class="container-fluid" style="padding-left:25%;padding-top:2%">
        <hr style="width:47%">
          <h4>Role permissions</h4>
          <div class="flex space-x-2 mt-4 pt-2">
            @if($role->permissions)
              @foreach($role->permissions as $role_permission)
                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white" method="POST"  action="{{ route('admin.roles.permissions.revoke', [$role->id,$role_permission->id]) }}" onsubmit="return confirm('Are you sure?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">{{ $role_permission->name }}</button>
                </form>
              @endforeach
            @endif
          </div>
          <form method="POST" action="{{route('admin.roles.permissions', $role->id)}}" class="py-3" style="width:46%;padding-left:1.5%;">
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
  
  
