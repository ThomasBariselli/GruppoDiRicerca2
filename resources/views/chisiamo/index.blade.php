<x-layout>
    <x-slot:heading>
        Chi Siamo - Gruppo di Ricerca
    </x-slot:heading>
  <div class="container-fluid" style="max-width: 800px;background-color: white;padding-top: 2%;padding-bottom: 2%;">
      <div class="container-fluid my-5 text-center" style="max-width: 550px;">
        
        <h2>IL NOSTRO TEAM<br></h2>
            <div class="container-fluid my-5" style="align-items:center">
            @role('teacher')
              <button type="button" class="btn btn-success" onclick="location.href='{{ route('chisiamo.create') }}'">Create Member</button>
            @endrole
            @foreach ($members as $member)
              <div class="card border-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title">{{ $member['name'] }} {{ $member['surname'] }}</h5>
                  <p class="card-text"><strong>{{ $member['role'] }}</strong></p>
                  <p class="card-text">{{ $member['description'] }}</p>
                </div>
                @role('teacher')
                  <form method="POST"  action="{{ route('chisiamo.destroy', $member->id) }}" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-primary mb-3" onclick="location.href='{{ route('chisiamo.edit', $member->id) }}'">Edit</button>
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
</x-layout>