<x-layout>
    <x-slot:heading>
        Reset password - Gruppo di Ricerca
    </x-slot:heading>
    <div class="container-fluid" style="max-width: 800px;background-color: white; padding-top:10%;padding-bottom:2%">
        <h2 class="text-center">Reset password</h2>
        <form method="POST" action="/send" class="py-3" style="max-width:550px;padding-left:28%">
            @csrf

            <div class="row mb-3 pb-3" >
                <label for="email" class="col-mb-1 col-form-label">Inserisci la tua email</label>
                <div class="col-mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>

                @error('email')
                    <p class="text-xs text-danger font-semibold mt-1"><i>{{ $message }}</i></p>
                @enderror
            </div>
            
            <hr>
            <div class="container-fluid d-flex justify-content-between pt-3 pb-2">
                <button type="submit" class="btn btn-secondary">Send</button>
            </div>
        </form>
    </div>
</x-layout>