@extends('layouts.app')
  <title>  
    Corsi - Gruppo di Ricerca
  </title>

  <div class="container-fluid d-flex mt-5" style="justify-content:center">
        <form method="POST" action="{{ route('corsi.update', $course->id) }}" class="py-3" style="width:40%;">
            @csrf
            @method('PUT')

            <div class="row mb-3" >
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-mb-3">
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome" value="{{ $course->name }}" required>
                </div>
                <label for="description" class="col-sm-2 col-form-label">Descrizione</label>
                <div class="col-mb-3">
                <input type="description" class="form-control" name="description" id="description" placeholder="Descrizione" value="{{ $course->description }}" required>
                </div>

                @error('name')
                    <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            
            <hr>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right">Update</button>
            </div>
        </form>
        
      </div>
