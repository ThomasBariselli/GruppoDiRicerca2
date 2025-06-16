<x-layout style="display: table">
    <x-slot:heading>
        Admin Panel - Gruppo Di Ricerca
    </x-slot:heading>
    <style>
        .nav-link.active-side{
            color:black;
            background-color:white;
        }
    </style>
    
    <div class="p-3 text-white bg-dark" style="width: 280px;display:table-cell;padding-top:15%">
    <ul class="nav nav-pills flex-column mb-auto" style="padding-top:30%;">
    <hr>
      <li class="nav-item">
        <a href="{{ route('admin.users.index') }}" class="nav-link text-white" aria-current="page">
          Utenti
        </a>
        <a href="{{ route('admin.roles.index') }}" class="nav-link text-white" aria-current="page">
          Ruoli
        </a>
      </li>
      <li>
        <a href="{{ route('admin.permissions.index') }}" class="nav-link active-side" style="margin-bottom:160%">
          Permessi
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <strong>{{ auth()->user()->email }}</strong>
      </a>
      <a class="text-white text-decoration-none" style="padding-left:30%" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        {{ auth()->user()->getRoleNames()->first() }}
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <li><hr class="dropdown-divider"></li>
        <form method="POST" action="/logout" class="d-flex justify-content-center">
          @csrf
          <li><button type="submit" class="btn btn-secondary" style="background-color:#343a40;border:none">Sign out</button></li>
        </form>
      </ul>
    </div>
  </div>

  <div class="container-fluid" style="display:table-cell;padding-top:5%;" >
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
                <div class="container-fluid pb-5">
                    <button type="submit" class="btn btn-success" style="float:right">Assign</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</x-layout>