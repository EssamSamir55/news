@extends('cms.parent')

@section('title' , 'Edit Category')

@section('main-title' , 'Edit Category')

@section('sub-title' , 'Edit Category')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit New Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">

                <div class="form-group col-md-6">

                  <label for="name">Category Name</label>
                  <input type="text" class="form-control" id="name" name="name"
                  value="{{$categories->name}}" placeholder="Enter Name of Category">
                </div>

                <div class="form-group col-md-6">
                  <label for="status"> Status</label>
                  <select class="form-select form-select-sm" name="status" style="width: 100%;"
                        id="status" aria-label=".form-select-sm example">


                        <option value="{{ $categories->status }}">{{ $categories->status }} </option>
                       <option value="Active">Active </option>
                       <option value="InActive">InActive </option>
                    </select>
               </div>
           </div>

           <div class="row">

           <div class="col-md-12">
             <div class="form-group">
                 <label for="description"> Description of Category</label>
                     <textarea class="form-control" style="resize: none;" id="description" name="description" rows="4"
                     placeholder="Enter Description of Category " cols="50">{{$categories->description}}</textarea>
             </div>
         </div>
       </div>

              <!-- /.card-body -->

              <div class="card-footer bg-white">
                <button type="button" onclick="performUpdate({{$categories->id}})" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.index') }}" type="submit" class="btn btn-success">Go Back</a>

            </div>
            </form>
          </div>
          <!-- /.card -->
        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section('scripts')

<script>
    function performUpdate(id){
        let formData = new FormData();
        formData.append('name',document.getElementById('name').value);
        formData.append('status',document.getElementById('status').value);
        formData.append('description',document.getElementById('description').value);

        storeRoute('/cms/admin/categories_update/'+id , formData)
    }
    </script>

@endsection
