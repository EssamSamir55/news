@extends('cms.parent')

@section('title' , 'Create Category')

@section('main-title' , 'Create Category')

@section('sub-title' , 'Create Category')

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
              <h3 class="card-title">Create New Category</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">

                <div class="form-group col-md-6">

                  <label for="name">Category Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of Category">
                </div>
           </div>

           <div class="row">
                <div class="form-group col-md-1">
                  <label for="status"> Status</label>
                  <select class="form-select form-select-sm" name="status" style="width: 100%;"
                        id="status" aria-label=".form-select-sm example">
                       <option value="active">Active </option>
                       <option value="inactive">InActive </option>
                    </select>
               </div>
               </div>

           <div class="row">

           <div class="col-md-12">
             <div class="form-group">
                 <label for="description"> Description of Category</label>
                     <textarea class="form-control" style="resize: none;" id="description" name="description" rows="4"
                     placeholder="Enter Description of Category " cols="50"></textarea>
             </div>
         </div>
       </div>

              <!-- /.card-body -->

              <div class="card-footer bg-white">
                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
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
    function performStore(){
        let formData = new FormData();
        formData.append('name',document.getElementById('name').value);
        formData.append('status',document.getElementById('status').value);
        formData.append('description',document.getElementById('description').value);
        store('/cms/admin/categories' , formData)
    }
    </script>

@endsection
