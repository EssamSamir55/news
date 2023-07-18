@extends('cms.parent')

@section('title' , 'Index Roles')

@section('main-title' , 'Index Roles')

@section('sub-title' , 'index Roles')

@section('styles')

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">

      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="{{ route('roles.create') }}" type="submit" class="btn btn-success">Add New roles</a>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Role Name</th>
                    <th>Guard Name</th>
                    <th>Permissions</th>

                    <th>Setting</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td><span class="badge text-white" style="background:{{$role->guard_name=='admin'?'green':'blue' }} ">({{$role->guard_name}})</td>

                      <td><a href="{{route('roles.permissions.index', $role->id)}}"
                        class="btn btn-info">({{$role->permissions_count}})
                        permissions/s</a> </td>
                    <td>

                    <div class="btn-group">
                        <a href="{{ route('roles.edit' , $role->id ) }}" type="button" class="btn btn-info">Edit</a>
                        <button type="button" onclick="performDestroy({{$role->id}} , this)" class="btn btn-danger">Delete</button>
                        {{-- <a href="{{ route('countries.show' , $roles->id) }}" type="button" class="btn btn-success">Show</a> --}}
                      </div></td>
                </tr>
                    @endforeach

                </tbody>
              </table>
            </div>

            {{ $roles->links() }}
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </div><!-- /.container-fluid -->
  </section>
@endsection


@section('scripts')

<script>
  function performDestroy(id , reference){

    confirmDestroy('/cms/admin/roles/'+id , reference);
  }
  </script>
@endsection
