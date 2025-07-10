@extends('layouts.app')
  
  <title>  
    Corsi - Gruppo di Ricerca
  </title>

  <div class="container-fluid d-flex mt-5" style="justify-content:center">
        <form method="POST" action="{{ route('corsi.update', $course->id) }}" class="py-3 mb-5" style="width:40%;margin-left:14%;margin-top:5%">
            @csrf
            @method('PUT')

            <div class="row mb-3" >
                <label for="name" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-mb-3">
                <input type="name" class="form-control" name="name" id="name" placeholder="Nome" value="{{ $course->name }}" required>
                </div>
                <label for="description" class="col-sm-2 col-form-label">Descrizione</label>
                <div class="col-mb-3">
                <input type="description" class="form-control" name="description" id="description" placeholder="Descrizione" value="{{ $course->description }}" required>
                </div>

                @error('name')
                    <p class="text-xs text-red" style="color:red">{{ $message }}</p>
                @enderror
                @error('leaderemail')
                    <p class="text-xs text-red" style="color:red">{{ $message }}</p>
                @enderror
            </div>
            
            <hr>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right">Update</button>
            </div>
        </form>
        <div class="container-fluid mt-5 mb-5" style="padding-left:25%;padding-top:2%">
          <h4>Course Members</h4>
          <div class="flex space-x-2 mt-4 pt-2">
            @if($course->users)
              @foreach($course->users as $course_users)
                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white" method="POST"  action="{{ route('corsi.chisiamo.revoke', [$course->id,$course_users->id]) }}" onsubmit="return confirm('Are you sure?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">{{ $course_users->firstname }}&nbsp;{{ $course_users->lastname }}</button>
                </form>
              @endforeach
            @endif
          </div>
          <form method="POST" action="{{route('corsi.chisiamo.assign', $course->id)}}" class="py-3" style="width:46%;padding-left:1.5%;">
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
