@extends('layouts.admin')
    <title>
        Admin Panel - Gruppo Di Ricerca
    </title>
    
  <div class="container-fluid text-center" style="padding-top:6%;margin-bottom:15%">
    <button type="button" class="btn btn-success" style="margin-left:67%" onclick="location.href='{{ route('admin.permissions.create') }}'">Create Permission</button>
    <table align="center" class="table table-striped table-dark mt-3" style="margin-right:5%;width:70%;">
              <thead style="color:grey">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-sx font-medium text-gray-500 uppercase">NOME</th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">EDIT</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                      @foreach ($permissions as $permission)
                      <tr>
                        <td>
                          <div >
                          {{ $permission->name }}
                          </div>
                        </td>
                        <td class="col-md-4 col-md-offset-2">
                          <form method="POST"  action="{{ route('admin.permissions.destroy', $permission->id) }}" onsubmit="return confirm('Are you sure?');">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-primary" onclick="location.href='{{ route('admin.permissions.edit', $permission->id) }}'">Edit</button>
                              <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
              </tbody>
      </table>
  </div>
