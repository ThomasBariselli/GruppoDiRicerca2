@extends('layouts.admin')
    <title>
        Admin Panel - Gruppo Di Ricerca
    </title>
    
  <div class="container-fluid text-center" style="padding-top:7%;padding-bottom:5%" >
    <button type="button" class="btn btn-success mb-4" style="margin-left:67%" onclick="location.href='{{ route('admin.roles.create') }}'">Create Role</button>
    <table align="center" class="table table-striped table-dark text-center" style="width:70%;margin-left:23%">
              <thead style="color:grey">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-sx font-medium text-gray-500 uppercase">NOME</th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">EDIT</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                      @foreach ($roles as $role)
                      <tr>
                        <td>
                          <div >
                          {{ $role->name }}
                          </div>
                        </td>
                        <td class="col-md-4 col-md-offset-2">
                            <form method="POST"  action="{{ route('admin.roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure?');">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-primary" onclick="location.href='{{ route('admin.roles.edit', $role->id) }}'">Edit</button>
                              <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                      </tr>
                      @endforeach
              </tbody>
      </table>
  </div>
  
