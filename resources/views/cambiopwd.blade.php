@extends('layouts.app')
    <title>
        Account - Gruppo di Ricerca
    </title>

    <div class="container-fluid" style="margin-top:7%">
        <h2 class="text-center">CAMBIO PASSWORD</h2>
        <form method="POST" action="{{ route('cambiopwd',auth()->user()->id)}}" class="mt-5 pb-5" style="width:40%;margin-left:30%">
            @csrf
            @method('PUT')

            <div class="row mb-3" >
                <label for="firstname" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-mb-3">
                <input type="firstname" class="form-control" name="firstname" id="firstname" placeholder="Nome" value="{{ auth()->user()->firstname }}" required>
                </div>
                <label for="lastname" class="col-sm-2 col-form-label">Cognome</label>
                <div class="col-mb-3">
                <input type="lastname" class="form-control" name="lastname" id="lastname" placeholder="Cognome" value="{{ auth()->user()->lastname }}" required>
                </div>
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ auth()->user()->email }}">
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