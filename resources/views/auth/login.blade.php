@extends('layouts.app')
    <title>
        Login - Gruppo di Ricerca
    </title>

    <div class="container-fluid" style="max-width: 800px;background-color: white; padding-top:10%;padding-bottom:2%">
        <h2 class="text-center">LOGIN</h2>
        <form method="POST" action="/login" class="py-3" style="max-width:550px;padding-left:28%">
            @csrf

            <div class="row mb-3" >
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                </div>

                @error('email')
                    <p class="text-xs text-danger font-semibold mt-1"><i>{{ $message }}</i></p>
                @enderror
            </div>
            <div class="row mb-3 ">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>

                @error('password')
                    <p class="text-xs text-danger font-semibold mt-1"><i>{{ $message }}</i></p>
                @enderror
            </div>
            <div class="container-fluid text-center pt-3 pb-3">
                <a class="text-underline text-secondary" href="/resetpassword">Reset password</a>
            </div>
            <hr>
            <div class="container-fluid d-flex justify-content-between pt-3">
                <button type="button" class="btn btn-light" style="border-color:grey;" onclick="location.href='/register'">Register</button>
                <button type="submit" class="btn btn-secondary">Sign in</button>
            </div>
        </form>
    </div>
