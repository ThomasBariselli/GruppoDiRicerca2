<x-layout>
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
        <a href="{{ route('admin.users.index') }}" class="nav-link active-side" aria-current="page">
          Utenti
        </a>
        <a href="{{ route('admin.roles.index') }}" class="nav-link text-white" aria-current="page">
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
  <div class="container-fluid text-center" style="padding-top:7%;padding-bottom:5%;display:table-cell" >
    <table align="center" class="table table-striped table-dark" style="width:70%;margin-left:23%">
              <thead style="color:grey">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-sx font-medium text-gray-500 uppercase">NOME</th>
                  <th scope="col" class="px-6 py-3 text-left text-sx font-medium text-gray-500 uppercase">COGNOME</th>
                  <th scope="col" class="px-6 py-3 text-left text-sx font-medium text-gray-500 uppercase">EMAIL</th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">EDIT</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <td>
                          <div >
                          {{ $user->firstname }}
                          </div>
                        </td>
                        <td>
                          <div >
                          {{ $user->lastname }}
                          </div>
                        </td>
                        <td>
                          <div >
                          {{ $user->email }}
                          </div>
                        </td>
                        <td class="col-md-4 col-md-offset-2">
                          <form method="POST"  action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?');">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-primary" onclick="location.href='{{ route('admin.users.show',$user->id) }}'">Ruoli</button>
                              <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
              </tbody>
      </table>
  </div>
</x-layout>