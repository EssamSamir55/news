@extends('cms.parent')

@section('title' , 'Index Admin')

@section('main-title' , 'Index Admin')

@section('sub-title' , 'index Admin')

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
            @can('Create Admin')
            <a href="{{ route('admins.create') }}" type="submit" class="btn btn-success">Add New Admin</a>
            @endcan
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
                    <th>Image</th>
                    <th>first Name</th>
                    <th>last Name</th>
                    <th>email</th>
                    <th>Gender</th>
                    <th>status</th>
                    <th>city</th>
                    <th>Setting</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                <tr>
                    <td>{{$admin->id}}</td>
                    <td>
                      <img class="img-circle img-bordered-sm" src="{{asset('storage/images/admin/'.$admin->user->image ?? "")}}" width="60" height="60" alt="User Image">
                   </td>
                    <td>{{$admin->user->firstname ?? ""}}</td>
                    <td>{{$admin->user->lastname ?? "" }}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->user->gender ?? ""}}</td>
                    <td>{{$admin->user->status ?? ""}}</td>
                    <td>{{$admin->user->city->name ?? ""}}</td>
                    <td>

                    <div class="btn-group">
                        {{-- @can('Edit Admin') --}}
                        <a href="{{ route('admins.edit' , $admin->id ) }}" type="button" class="btn btn-outline-info">Edit</a>
                        {{-- @endcan --}}
                        @can('Delete Admin')
                        <button type="button" onclick="performDestroy({{$admin->id}} , this)" class="btn btn-outline-danger">Delete</button>
                        @endcan
                        <a href="{{ route('admins.show' , $admin->id) }}" type="button" class="btn btn-outline-success">Show</a>
                      </div>
                    </td>
                </tr>
                    @endforeach

                </tbody>
              </table>
            </div>

            {{ $admins->links() }}
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

    confirmDestroy('/cms/admin/admins/'+id , reference);
  }
  </script>
@endsection
