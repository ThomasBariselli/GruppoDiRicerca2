@extends('layouts.app')
    <title>
        Chi Siamo - Gruppo di Ricerca
    </title>

  <div class="container-fluid d-flex pt-5" style="justify-content:center">
  <form method="POST" action="{{ route('chisiamo.store') }}" class="py-3" style="width:40%;">
            @csrf
            <div class="row mb-3" >
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-mb-3">
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome" required>
                </div>
                <label for="surname" class="col-sm-2 col-form-label">Cognome</label>
                <div class="col-mb-3">
                <input type="surname" class="form-control" name="surname" id="surname" placeholder="Cognome" required>
                </div>
                <label for="role" class="col-sm-2 col-form-label">Titolo</label>
                <div class="col-mb-3">
                <input type="role" class="form-control" name="role" id="role" placeholder="Titolo" required>
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
