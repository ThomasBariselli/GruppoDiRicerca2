@extends('layouts.app')
  <title>  
    Corsi - Gruppo di Ricerca
  </title>

  <div class="container-fluid d-flex pt-5" style="justify-content:center">
  <form method="POST" action="{{ route('pubblicazioni.store') }}" class="py-3" style="width:40%;">
            @csrf
            <div class="row mb-3" >
                <label for="title" class="col-sm-2 col-form-label">Titolo</label>
                <div class="col-mb-3">
                <input type="title" class="form-control" name="title" id="title" placeholder="Titolo" required>
                </div>
                <label for="doi" class="col-sm-2 col-form-label">DOI</label>
                <div class="col-mb-3">
                <input type="doi" class="form-control" name="doi" id="doi" placeholder="DOI" required>
                </div>
                <label for="inbook" class="col-sm-2 col-form-label">In Book</label>
                <div class="col-mb-3">
                <input type="inbook" class="form-control" name="inbook" id="inbook" placeholder="In-Book">
                </div>
                <label for="description" class="col-sm-2 col-form-label">Descrizione</label>
                <div class="col-mb-3">
                <input type="description" class="form-control" name="description" id="description" placeholder="Descrizione">
                </div>

                @error('doi')
                    <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            
            <hr>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right">Save</button>
            </div>
        </form>
        
  </div>
