@extends('layouts.admin')

    <title>
        Admin Panel - Gruppo Di Ricerca
    </title>
    
  <div class="container-fluid text-center" style="padding-top:7%;padding-bottom:5%" >
    <table align="center" class="table table-striped table-dark text-center" style="width:70%;margin-left:23%">
              <thead style="color:grey">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-sx font-medium text-gray-500 uppercase">NOME</th>
                  <th scope="col" class="px-6 py-3 text-left text-sx font-medium text-gray-500 uppercase">COGNOME</th>
                  <th scope="col" class="px-6 py-3 text-left text-sx font-medium text-gray-500 uppercase">EMAIL</th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">EDIT</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <td>
                          <div >
                          {{ $user->firstname }}
                          </div>
                        </td>
                        <td>
                          <div >
                          {{ $user->lastname }}
                          </div>
                        </td>
                        <td>
                          <div >
                          {{ $user->email }}
                          </div>
                        </td>
                        <td class="col-md-4 col-md-offset-2">
                          <form method="POST"  action="{{ route('admin.users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?');">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-primary" onclick="location.href='{{ route('admin.users.show',$user->id) }}'">Ruoli</button>
                              <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
              </tbody>
      </table>
  </div>
