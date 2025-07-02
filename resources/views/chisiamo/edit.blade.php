@extends('layouts.app')
    <title>
        Chi Siamo - Gruppo di Ricerca
    </title>

    <div class="container-fluid d-flex mt-5" style="justify-content:center">
        <form method="POST" action="{{ route('chisiamo.update', $member->id) }}" class="py-3 mt-5 mb-5" style="width:40%;margin-left:14%">
            @csrf
            @method('PUT')

            <div class="row mb-3" >
                <label for="firstname" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-mb-3">
                <input type="firstname" class="form-control" name="firstname" id="firstname" placeholder="Nome" value="{{ $member->firstname }}" required>
                </div>
                <label for="lastname" class="col-sm-2 col-form-label">Cognome</label>
                <div class="col-mb-3">
                <input type="lastname" class="form-control" name="lastname" id="lastname" placeholder="Cognome" value="{{ $member->lastname }}" required>
                </div>
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $member->email }}" required>
                </div>

                @error('name')
                    <p class="text-xs text-red-500 font-semibold mt-1 italic">{{ $message }}</p>
                @enderror
            </div>
            
            <hr>
            <div class="container-fluid">
                <button type="submit" class="btn btn-success" style="float:right">Update</button>
            </div>
        </form>
        <div class="container-fluid mt-5 mb-5" style="padding-left:25%;padding-top:2%">
          <h4>Member Courses</h4>
          <div class="flex space-x-2 mt-4 pt-2">
            @if($member->courses)
              @foreach($member->courses as $member_courses)
                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white" method="POST"  action="{{ route('chisiamo.corsi.revoke', [$member->id,$member_courses->id]) }}" onsubmit="return confirm('Are you sure?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">{{ $member_courses->name }}</button>
                </form>
              @endforeach
            @endif
          </div>
          <form method="POST" action="{{route('chisiamo.corsi.assign', $member->id)}}" class="py-3" style="width:46%;padding-left:1.5%;">
            @csrf
              <div class="row mb-3" >
                  <label for="course" class="col-sm-2 col-form-label">Corsi</label>
                  <select data-mdb-select-init id="course" name="course" autocomplete="course-name" class="mt-1 block w-full py-2 px-3" style="border-radius: 5px;">
                    @foreach($courses as $course)
                      <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                  </select>
                  @error('course')
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
