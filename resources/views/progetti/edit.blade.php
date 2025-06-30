@extends('layouts.app')
  <title>  
    Progetti - Gruppo di Ricerca
  </title>

  <div class="container-fluid d-flex mt-5" style="justify-content:center">
        <form method="POST" action="{{ route('progetti.update', $project->id) }}" class="py-3 mb-5" style="width:40%;margin-left:14%;margin-top:5%">
            @csrf
            @method('PUT')

            <div class="row mb-3" >
                <label for="title" class="col-sm-2 col-form-label">Titolo</label>
                <div class="col-mb-3">
                <input type="title" class="form-control" name="title" id="title" value="{{ $project->title }}" required>
                </div>
                <label for="status" class="col-sm-2 col-form-label">Stato</label>
                  <select data-mdb-select-init id="status" name="status" autocomplete="course-name" class="block w-full py-2 px-3" style="margin-left:3.5%;border-radius: 5px;width:93.5%">
                    <option value="In corso">In corso</option>
                    <option value="Completato">Completato</option>
                  </select>
                <label for="description" class="col-sm-2 col-form-label">Descrizione</label>
                <div class="col-mb-3">
                <input type="description" class="form-control" name="description" id="description" value="{{ $project->description }}" required>
                </div>

                @error('title')
                    <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            
            <hr>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right">Update</button>
            </div>
        </form>
        <div class="container-fluid mt-5 mb-5" style="padding-left:25%;padding-top:2%">
          <h4>Autori</h4>
          <div class="flex space-x-2 mt-4 pt-2">
            @if($project->users)
              @foreach($project->users as $project_users)
                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white" method="POST"  action="{{ route('progetti.members.revoke', [$project->id,$project_users->id]) }}" onsubmit="return confirm('Are you sure?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">{{ $project_users->firstname }}&nbsp;{{ $project_users->lastname }}</button>
                </form>
              @endforeach
            @endif
          </div>
          <form method="POST" action="{{route('progetti.members.assign', $project->id)}}" class="py-3" style="width:46%;padding-left:1.5%;">
            @csrf
              <div class="row mb-3" >
                  <label for="member" class="col-sm-2 col-form-label">Membri</label>
                  <select data-mdb-select-init id="member" name="member" autocomplete="course-name" class="mt-1 block w-full py-2 px-3" style="border-radius: 5px;">
                    @foreach($members as $member)
                      @if($member->getRoleNames()->first()=='teacher' || $member->getRoleNames()->first()=='collab' || $member->getRoleNames()->get(1)=='collab' || $member->getRoleNames()->get(1)=='teacher')  
                        <option value="{{ $member->id }}">{{ $member->firstname }}&nbsp;{{ $member->lastname }}</option>
                      @endif
                    @endforeach
                  </select>
                  @error('member')
                      <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                  @enderror
              </div>
              <hr>
              <div class="container-fluid pb-5">
                  <button type="submit" class="btn btn-success" style="float:right">Assign</button>
              </div>
          </form>
        </div>
      </div>
