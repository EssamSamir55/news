@extends('cms.parent')

@section('title' , 'Index comment')

@section('main-title' , 'Index comment')

@section('sub-title' , 'index comment')

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
            <a href="{{ route('comments.create') }}" type="submit" class="btn btn-success">Add New comment</a>

            <div class="row search">

                <div class="card-tools start-0">
                <form action="" method="get" style="margin-bottom:2%;" class="pt-0 pt-sm-3">
                    <div class="row">
                        <div class="input-icon col-md-3">
                            <input type="text" class="form-control" placeholder="Search By Name"
                            name='name' @if( request()->title) value={{request()->title}} @endif/>
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
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
                    <th>Comment</th>
                    <th>Article Name</th>
                    <th>Viewer Name</th>
                    <th>Setting</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
            <tr>
                <td>{{$comment->comment}}</td>
                <td>{{$comment->article->name}}</td>
                <td>{{$comment->viewer->name}}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('categories.edit' , $comment->id ) }}" type="button" class="btn btn-info">Edit</a>
                        <button type="button" onclick="performDestroy({{$comment->id}} , this)" class="btn btn-danger">Delete</button>
                        <a href="{{ route('categories.show' , $comment->id) }}" type="button" class="btn btn-success">Show</a>
                    </div>
                </td>
            </tr>
                    @endforeach

                </tbody>
              </table>
            </div>

            {{ $comments->links() }}
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

    confirmDestroy('/cms/admin/comments/'+id , reference);
  }
  </script>
@endsection
