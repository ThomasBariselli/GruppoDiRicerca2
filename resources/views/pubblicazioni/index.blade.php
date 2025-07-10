@extends('layouts.app')
  @php
    $activeMenu = 'pubblicazioni';
  @endphp

  <title>  
    Pubblicazioni - Gruppo di Ricerca
  </title>

  <div class="container-fluid" style="max-width: 800px;background-color: white;padding-top: 2%;padding-bottom: 2%;">
      <div class="container-fluid my-5 text-center" style="max-width: 550px;">
        
        <h2>LE NOSTRE PUBBLICAZIONI<br></h2>
            <div class="container-fluid" style="align-items:center">
            @can('edit-publication')
            <form method="POST" class="mt-4 mb-4" action="{{ route('pubblicazioni.create') }}">
              @csrf
              <button type="submit" class="btn btn-success">Create Pubblicazione</button>
            </form>
            @endcan
            @foreach ($pubblicazioni as $pubblicazione)
              <div class="card border-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title">{{ $pubblicazione['title'] }}</h5>
                  <p class="card-text"><strong>DOI: </strong>{{ $pubblicazione['doi'] }}</p>
                  <p class="card-text"><strong>In book: </strong>{{ $pubblicazione['inbook'] }}</p>
                  <p class="card-text"><strong>Leader: </strong>{{ $pubblicazione['leaderemail'] }}</p>
                  <p class="card-text"><strong>Autori: </strong>
                  @foreach($pubblicazione->users as $pubblicazione_user)
                    {{ $pubblicazione_user->firstname }}&nbsp;{{ $pubblicazione_user->lastname }},
                  @endforeach
                  </p>
                  <p class="card-text"><strong>Descrizione: </strong>{{ $pubblicazione['description'] }}</p>
                </div>
                @auth
                @if($pubblicazione->leaderemail==auth()->user()->email || $pubblicazione->users->contains(auth()->user()->id))
                  @can('edit-publication')
                    <form method="POST"  action="{{ route('pubblicazioni.destroy', $pubblicazione->id) }}" onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-primary mb-3" onclick="location.href='{{ route('pubblicazioni.edit', $pubblicazione->id) }}'">Edit</button>
                      <button type="submit" class="btn btn-danger mb-3">Delete</button>
                    </form>
                  @endcan
                @endif
                @endauth
              </div>
            @endforeach
            </div>
          </button>
        </div>
      </div>
      
  </div>
