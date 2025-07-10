@extends('layouts.app')

  <title>  
    Pubblicazioni - Gruppo di Ricerca
  </title>

  <div class="container-fluid d-flex pt-5" style="justify-content:center">
  <form method="POST" action="{{ route('pubblicazioni.store') }}" class="py-3" style="width:40%;">
            @csrf
            <div class="row mb-3" >
                <label for="title" class="col-sm-2 col-form-label">Titolo</label>
                <div class="col-mb-3">
                <input type="title" class="form-control" name="title" id="title" placeholder="Titolo" required>
                </div>
                <label for="leaderemail" class="col-sm-3 col-form-label">Email leader</label>
                <div class="col-mb-3">
                <input type="leaderemail" class="form-control" name="leaderemail" id="leaderemail" placeholder="Email leader" required>
                </div>
                @error('leaderemail')
                    <p class="text-xs text-red" style="color:red">{{ $message }}</p>
                @enderror
                <label for="doi" class="col-sm-2 col-form-label">DOI</label>
                <div class="col-mb-3">
                <input type="doi" class="form-control" name="doi" id="doi" placeholder="DOI" required>
                </div>
                @error('doi')
                    <p class="text-xs text-red" style="color:red">{{ $message }}</p>
                @enderror
                <label for="inbook" class="col-sm-2 col-form-label">In Book</label>
                <div class="col-mb-3">
                <input type="inbook" class="form-control" name="inbook" id="inbook" placeholder="In-Book">
                </div>
                <label for="description" class="col-sm-2 col-form-label">Descrizione</label>
                <div class="col-mb-3">
                <input type="description" class="form-control" name="description" id="description" placeholder="Descrizione">
                </div>
            </div>
            
            <hr>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right">Save</button>
            </div>
        </form>
        
  </div>
