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
  <div class="container-fluid" style="display:table-cell;padding-top:5%;" >
        <form method="POST" action="{{ route('admin.roles.store') }}" class="py-3" style="padding-left:25%;width:60%">
            @csrf

            <div class="row mb-3" >
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-mb-3">
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome" required>
                </div>

                @error('name')
                    <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            
            <hr>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right">Save</button>
            </div>
        </form>
        
      </div>
  
  
</x-layout>