@extends('layouts.app')
  <title>  
    Progetti - Gruppo di Ricerca
  </title>

  <div class="container-fluid" style="max-width: 800px;background-color: white;padding-top: 2%;padding-bottom: 2%;">
      <div class="container-fluid my-5 text-center" style="max-width: 550px;">
        
        <h2>I NOSTRI PROGETTI<br></h2>
            <div class="container-fluid" style="align-items:center">
            @can('edit-project')
            <form method="POST" class="mt-4 mb-4" action="{{ route('progetti.create') }}">
              @csrf
              <button type="submit" class="btn btn-success">Create Project</button>
            </form>
            @endcan
            @foreach ($projects as $project)
              <div class="card border-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title">{{ $project['title'] }}</h5>
                  <p class="card-text"><strong>Stato: </strong>{{ $project['status'] }}</p>
                  <p class="card-text"><strong>Autori: </strong>
                  @foreach($project->users as $project_user)
                    {{ $project_user->firstname }}&nbsp;{{ $project_user->lastname }},
                  @endforeach
                  </p>
                  <p class="card-text"><strong>Descrizione: </strong>{{ $project['description'] }}</p>
                </div>
                @can('edit-project')
                  <form method="POST"  action="{{ route('progetti.destroy', $project->id) }}" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-primary mb-3" onclick="location.href='{{ route('progetti.edit', $project->id) }}'">Edit</button>
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
