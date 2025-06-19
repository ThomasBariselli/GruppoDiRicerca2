@extends('layouts.admin')
    <title>
        Admin Panel - Gruppo Di Ricerca
    </title>

  <div class="container-fluid" style="padding-top:5%;padding-left:25%" >
        @if(Session::has('message'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert"><!---->
            <strong>{{Session::get('message')}}</strong>
            <button type="button" class="close" data-bs-dismiss="alert" style="background-color:#fff3cd;border:none" aria-label="Close"><!--"-->
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
        <form method="POST" action="{{route('admin.permissions.update', $permission->id)}}" class="py-3" style="padding-left:25%;width:60%">
            @csrf
            @method('PUT')

            <div class="row mb-3" >
                <label for="name" class="col-sm-2 col-form-label">Permission name</label>
                <div class="col-mb-3">
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome" value="{{ $permission->name }}" required>
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
            <h4>Roles</h4>
            <div class="flex space-x-2 mt-4 pt-2">
              @if($permission->roles)
                @foreach($permission->roles as $permission_role)
                  <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white" method="POST"  action="{{ route('admin.permissions.roles.remove', [$permission->id,$permission_role->id]) }}" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ $permission_role->name }}</button>
                  </form>
                @endforeach
              @endif
            </div>
            <form method="POST" action="{{route('admin.permissions.roles', $permission->id)}}" class="py-3" style="width:46%;padding-left:1.5%;">
              @csrf
                <div class="row mb-3" >
                    <label for="role" class="col-sm-2 col-form-label">Permission</label>
                    <select data-mdb-select-init id="role" name="role" autocomplete="role-name" class="mt-1 block w-full py-2 px-3" style="border-radius: 5px;">
                      @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                      @endforeach
                    </select>
                    @error('role')
                        <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="container-fluid pb-5 pl-5">
                    <button type="submit" class="btn btn-success" style="float:right;">Assign</button>
                </div>
            </form>
          </div>
        </div>
  </div>
