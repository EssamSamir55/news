@extends('cms.parent')

@section('title' , 'Show Category')

@section('main-title' , 'Show Category')

@section('sub-title' , 'Show Category')

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
              <h3 class="card-title">Show Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">

                <div class="form-group col-md-6">

                  <label for="name">Category Name</label>
                  <input disabled type="text" class="form-control" id="name" name="name"
                  value="{{$categories->name}}" placeholder="Enter Name of Category">
                </div>
           </div>

           <div class="row">
            <div class="form-group">
              <label for="status"> Status</label>
              <select disabled class="form-select form-select-sm" name="status" style="width: 100%;"
                    id="status" aria-label=".form-select-sm example">
                    <option selected> {{ $categories->status }} </option>
                    <option value="active">Active </option>
                   <option value="inactive">InActive </option>
                </select>
           </div>
       </div>

           <div class="row">

           <div class="col-md-12">
             <div class="form-group">
                 <label for="description"> Description of Category</label>
                     <textarea disabled class="form-control" style="resize: none;" id="description" name="description" rows="4"
                     placeholder="Enter Description of Category " cols="50">{{$categories->description}}</textarea>
             </div>
         </div>
         <div class="btns py-3">
            <a href="{{ route('categories.index') }}" type="submit" class="btn btn-info">Go Back</a>
            </div>
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
