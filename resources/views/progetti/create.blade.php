@extends('layouts.app')
  <title>  
    Progetti - Gruppo di Ricerca
  </title>

  <div class="container-fluid d-flex pt-5" style="justify-content:center">
  <form method="POST" action="{{ route('progetti.store') }}" class="py-3" style="width:40%;">
            @csrf
            <div class="row mb-3" >
                <label for="title" class="col-sm-2 col-form-label">Titolo</label>
                <div class="col-mb-3">
                <input type="title" class="form-control" name="title" id="title" placeholder="Titolo" required>
                </div>
                <label for="status" class="col-sm-2 col-form-label">Stato</label>
                <div class="col-mb-3">
                <input type="status" class="form-control" name="status" id="status" placeholder="Stato" value="In corso" readonly>
                </div>
                <label for="description" class="col-sm-2 col-form-label">Descrizione</label>
                <div class="col-mb-3">
                <input type="description" class="form-control" name="description" id="description">
                </div>

                @error('title')
                    <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            
            <hr>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right">Save</button>
            </div>
        </form>
        
  </div>
