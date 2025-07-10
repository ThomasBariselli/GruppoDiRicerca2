@extends('layouts.app')
  @php
    $activeMenu = 'corsi';
  @endphp
  <title>  
    Corsi - Gruppo di Ricerca
  </title>

  <div class="container-fluid" style="max-width: 800px;background-color: white;padding-top: 2%;padding-bottom: 2%;">
      <div class="container-fluid my-5 text-center" style="max-width: 550px;">
        
        <h2>I NOSTRI CORSI<br></h2>
            <div class="container-fluid" style="align-items:center">
            @can('edit-course')
            <form method="POST" class="mt-4 mb-4" action="{{ route('corsi.create') }}">
              @csrf
              <button type="submit" class="btn btn-success">Create Course</button>
            </form>
            @endcan
            @foreach ($courses as $course)
              <div class="card border-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title">{{ $course['name'] }}</h5>
                  <p class="card-text"><strong>Capo del corso: </strong>{{ $course['leaderemail'] }}</p>
                  <p class="card-text"><strong>Docenti</strong>
                  @foreach($course->users as $course_user)
                    {{ $course_user->firstname }}&nbsp;{{ $course_user->lastname }},
                  @endforeach
                  </p>
                  <p class="card-text">{{ $course['description'] }}</p>
                </div>
                @auth
                @if($course->leaderemail==auth()->user()->email || $course->users->contains(auth()->user()->id))
                  @can('edit-course')
                    <form method="POST"  action="{{ route('corsi.destroy', $course->id) }}" onsubmit="return confirm('Are you sure?');">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-primary mb-3" onclick="location.href='{{ route('corsi.edit', $course->id) }}'">Edit</button>
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
