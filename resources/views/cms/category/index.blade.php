@extends('cms.parent')

@section('title' , 'Index Category')

@section('main-title' , 'Index Category')

@section('sub-title' , 'index category')

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
              <a href="{{ route('categories.create') }}" type="submit" class="btn btn-success">Add New category</a>

              <div class="row search">

                <div class="card-tools start-0">
                  <form action="" method="get" style="margin-bottom:2%;" class="pt-0 pt-sm-3">
                      <div class="row">
                          <div class="input-icon col-md-3">
                              <input type="text" class="form-control" placeholder="Search By Name"
                                 name='name' @if( request()->name) value={{request()->name}} @endif/>
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                              </div>

                              {{-- <div class="input-icon col-md-4">
                                  <input type="text" class="form-control" placeholder="Search By status"
                                     name='status' @if( request()->status) value={{request()->status}} @endif/>
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                  </div> --}}
                                  <div class="col-md-3">
                                  <select class="form-select form-select-sm" name="status"
                                  id="status" aria-label=".form-select-sm example" @if( request()->status) value={{request()->status}} @endif/ >
                                 <option value="active">Active </option>
                                 <option value="inactive">InActive </option>
                              </select>
                            </div>
                      <div class="col-md-6">
                            <button style="
                            background-color:#0a0a23;
                            color: #fff;
                            border:none;

                            border-radius:10px;
                            box-shadow: 0px 0px 2px 2px rgb(0,0,0);" class="btn btn-success btn-md" id="filter" type="submit"> Filter</button>
                            <a href="{{route('categories.index')}}"  class="btn btn-danger" style="
                            background-color:#e90a3e;
                            color: #fff;
                            border:none;
                            border-radius:10px;
                            box-shadow: 0px 0px 2px 2px #e90a3e;">End Filter</a>
                            {{-- @can('Create-City') --}}

                            {{-- <a href="{{route('countries.create')}}"><button type="button" class="btn btn-md btn-primary"> Add New Country </button></a> --}}
                            {{-- @endcan --}}
                      </div>

                           </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>status</th>
                    {{-- <th>Desc</th> --}}

                    <th>Setting</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td><span class="badge text-white" style="background:{{$category->status=='active'?'green':'red' }} " >({{$category->status}})</span></td>



                    <td>
                    <div class="btn-group">
                        <a href="{{ route('categories.edit' , $category->id ) }}" type="button" class="btn btn-info">Edit</a>
                        <button type="button" onclick="performDestroy({{$category->id}} , this)" class="btn btn-danger">Delete</button>
                        <a href="{{ route('categories.show' , $category->id) }}" type="button" class="btn btn-success">Show</a>
                    </div></td>
                </tr>
                    @endforeach

                </tbody>
              </table>
            </div>

            {{ $categories->links() }}
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

    confirmDestroy('/cms/admin/categories/'+id , reference);
  }
  </script>
@endsection
