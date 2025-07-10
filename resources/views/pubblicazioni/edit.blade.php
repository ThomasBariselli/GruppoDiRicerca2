@extends('layouts.app')

  <title>  
    Pubblicazioni - Gruppo di Ricerca
  </title>

  <div class="container-fluid d-flex mt-5" style="justify-content:center">
        <form method="POST" action="{{ route('pubblicazioni.update', $publication->id) }}" class="py-3 mb-5" style="width:40%;margin-left:14%;margin-top:5%">
            @csrf
            @method('PUT')

            <div class="row mb-3" >
                <label for="title" class="col-sm-2 col-form-label">Titolo</label>
                <div class="col-mb-3">
                <input type="title" class="form-control" name="title" id="title" value="{{ $publication->title }}" required>
                </div>
                <label for="doi" class="col-sm-2 col-form-label">DOI</label>
                <div class="col-mb-3">
                <input type="doi" class="form-control" name="doi" id="doi" value="{{ $publication->doi }}" required>
                </div>
                <label for="inbook" class="col-sm-2 col-form-label">In Book</label>
                <div class="col-mb-3">
                <input type="inbook" class="form-control" name="inbook" id="inbook" value="{{ $publication->inbook }}" required>
                </div>
                <label for="description" class="col-sm-2 col-form-label">Descrizione</label>
                <div class="col-mb-3">
                <input type="description" class="form-control" name="description" id="description" value="{{ $publication->description }}" required>
                </div>

                @error('doi')
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
            @if($publication->users)
              @foreach($publication->users as $publication_users)
                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white" method="POST"  action="{{ route('pubblicazioni.members.revoke', [$publication->id,$publication_users->id]) }}" onsubmit="return confirm('Are you sure?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">{{ $publication_users->firstname }}&nbsp;{{ $publication_users->lastname }}</button>
                </form>
              @endforeach
            @endif
          </div>
          <form method="POST" action="{{route('pubblicazioni.members.assign', $publication->id)}}" class="py-3" style="width:46%;padding-left:1.5%;">
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
