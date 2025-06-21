@extends('layouts.app')
    <title>
        Chi Siamo - Gruppo di Ricerca
    </title>

  <div class="container-fluid" style="max-width: 800px;background-color: white;padding-top: 2%;padding-bottom: 2%;">
      <div class="container-fluid my-5 text-center" style="max-width: 550px;">
        
        <h2>IL NOSTRO TEAM<br></h2>
            <div class="container-fluid my-5" style="align-items:center">
            @can('edit-member')
            <form method="POST"  action="{{ route('chisiamo.create') }}">
                @csrf
                <button type="submit" class="btn btn-success">Create Member</button>
            </form>
            @endcan
            @foreach ($members as $member)
              <div class="card border-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title">{{ $member['name'] }} {{ $member['surname'] }}</h5>
                  <p class="card-text"><strong>{{ $member['role'] }}</strong></p>
                  <p class="card-text">{{ $member['description'] }}</p>
                </div>
                @can('edit-member')
                  <form method="POST"  action="{{ route('chisiamo.destroy', $member->id) }}" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-primary mb-3" onclick="location.href='{{ route('chisiamo.edit', $member->id) }}'">Edit</button>
                    <button type="submit" class="btn btn-danger mb-3">Delete</button>
                  </form>
                @endcan
              </div>
            @endforeach
            </div>
          </button>
        </div>
      </div>
  </div>
