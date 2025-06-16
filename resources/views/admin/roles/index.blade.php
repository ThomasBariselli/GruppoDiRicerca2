<x-layout style="display:table">
    <x-slot:heading>
        Admin Panel - Gruppo Di Ricerca
    </x-slot:heading>
    <style>
        .nav-link.active-side{
            color:black;
            background-color:white;
        }
    </style>
    <div class="p-3 text-white bg-dark" style="width: 280px;display:table-cell">
    <ul class="nav nav-pills flex-column mb-auto" style="padding-top:30%;">
      <hr>
      <li class="nav-item">
        <a href="{{ route('admin.users.index') }}" class="nav-link text-white" aria-current="page">
          Utenti
        </a>
        <a href="{{ route('admin.roles.index') }}" class="nav-link active-side" aria-current="page">
          Ruoli
        </a>
      </li>
      <li>
        <a href="{{ route('admin.permissions.index') }}" class="nav-link text-white" style="margin-bottom:160%">
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
  <div class="container-fluid text-center" style="display:table-cell;padding-top:5%;max-width:500px" >
    <button type="button" class="btn btn-success" style="margin-bottom:1%;margin-right:23%;float:right" onclick="location.href='{{ route('admin.roles.create') }}'">Create Role</button>
    <table align="center" class="table table-striped table-dark" style="width:70%;">
              <thead style="color:grey">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-sx font-medium text-gray-500 uppercase">NOME</th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">EDIT</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                      @foreach ($roles as $role)
                      <tr>
                        <td>
                          <div >
                          {{ $role->name }}
                          </div>
                        </td>
                        <td class="col-md-4 col-md-offset-2">
                            <form method="POST"  action="{{ route('admin.roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure?');">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-primary" onclick="location.href='{{ route('admin.roles.edit', $role->id) }}'">Edit</button>
                              <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                      </tr>
                      @endforeach
              </tbody>
      </table>
  </div>
  
</x-layout>