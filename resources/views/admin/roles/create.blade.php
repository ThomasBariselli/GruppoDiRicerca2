@extends('layouts.admin')
    <title>
        Admin Panel - Gruppo Di Ricerca
    </title>
    
  <div class="container-fluid" style="padding-top:5%;padding-bottom:5%" >
        <form method="POST" action="{{ route('admin.roles.store') }}" class="py-3" style="margin-left:38%;width:40%">
            @csrf

            <div class="row mb-3" >
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-mb-3">
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome" required>
                </div>

                @error('name')
                    <p class="text-xs text-red" style="color:red">{{ $message }}</p>
                @enderror
            </div>
            
            <hr>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right">Save</button>
            </div>
        </form>
        
  </div>
  
  
