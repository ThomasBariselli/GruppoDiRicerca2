@extends('layouts.app')
    <title>
        Register - Gruppo Di Ricerca
    </title>

    <div class="container-fluid" style="max-width: 800px;background-color: white; padding-top:10%;padding-bottom:2%">
        <h2 class="text-center">REGISTRATI</h2>
        <form method="POST" action="/register" class="py-3" style="max-width:550px;padding-left:28%">
            @csrf

            <div class="row mb-3" >
                <label for="first-name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-mb-3">
                <input type="first-name" class="form-control" name="first-name" id="first-name" placeholder="Nome" required>
                </div>

                @error('first-name')
                    <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="row mb-3" >
                <label for="last-name" class="col-sm-2 col-form-label">Cognome</label>
                <div class="col-mb-3">
                <input type="last-name" class="form-control" name="last-name" id="last-name" placeholder="Cognome" required>
                </div>

                @error('last-name')
                    <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="row mb-3" >
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>

                @error('email')
                    <p class="text-xs text-danger font-semibold mt-1"><i>{{ $message }}</i></p>
                @enderror
            </div>
            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>

                @error('password')
                    <i class="text-xs text-danger font-semibold mt-1">{{ $message }}</i>
                @enderror
            </div>
            <div class="row mb-3 pb-5">
                <label for="password_confirmation" class="col-mb-2 col-form-label">Confirm Password</label>
                <div class="col-mb-3">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                </div>

                @error('password')
                    <i class="text-xs text-danger font-semibold mt-1">{{ $message }}</i>
                @enderror
            </div>
            <!--
            <div class="row mb-3 pb-4">
                <div class="col-mb-3 ">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" required>
                        <label class="form-check-label" for="gridCheck1">
                        Example checkbox
                        </label>
                    </div>
                </div>
            </div>
            -->
            <hr>
            <div class="container-fluid d-flex justify-content-between pt-3">
                <button type="button" class="btn btn-danger" onclick="window.location.href='/register'">Cancel</button>
                <button type="submit" class="btn btn-secondary">Save</button>
            </div>
        </form>
    </div>
