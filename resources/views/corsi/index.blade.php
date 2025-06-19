@extends('layouts.app')
  <title>  
    Corsi - Gruppo di Ricerca
  </title>

  <div class="container-fluid" style="max-width: 800px;background-color: white;padding-top: 2%;padding-bottom: 2%;">
      <div class="container-fluid my-5 text-center" style="max-width: 550px;">
        
        <h2>I NOSTRI CORSI<br></h2>
            <div class="container-fluid my-5" style="align-items:center">
            @role('teacher')
              <button type="button" class="btn btn-success" onclick="location.href='{{ route('corsi.create') }}'">Create Course</button>
            @endrole
            @foreach ($courses as $course)
              <div class="card border-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title">{{ $course['name'] }}</h5>
                  //<p class="card-text"><strong>{{ $course['members'] }}</strong></p>
                  <p class="card-text">{{ $course['description'] }}</p>
                </div>
                @role('teacher')
                  <form method="POST"  action="{{ route('corsi.destroy', $course->id) }}" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-primary mb-3" onclick="location.href='{{ route('corsi.edit', $course->id) }}'">Edit</button>
                    <button type="submit" class="btn btn-danger mb-3">Delete</button>
                  </form>
                @endrole
              </div>
            @endforeach
            </div>
          </button>
        </div>
      </div>
  </div>
