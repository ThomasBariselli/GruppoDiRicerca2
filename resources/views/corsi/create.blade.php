<x-layout>
  <x-slot:heading>  
    Corsi - Gruppo di Ricerca
  </x-slot:heading>
  <div class="container-fluid d-flex pt-5" style="justify-content:center">
  <form method="POST" action="{{ route('corsi.store') }}" class="py-3" style="width:40%;">
            @csrf
            <div class="row mb-3" >
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-mb-3">
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome" required>
                </div>
                <label for="description" class="col-sm-2 col-form-label">Descrizione</label>
                <div class="col-mb-3">
                <input type="description" class="form-control" name="description" id="description" placeholder="Descrizione" required>
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