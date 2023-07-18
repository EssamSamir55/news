@extends('cms.parent')

@section('title' , 'Create Permission')

@section('main-title' , 'Create Permission')

@section('sub-title' , 'Create Permission')

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
              <h3 class="card-title">Create New Permission</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">

                <div class="form-group col-md-6">

                  <label for="name">Permission Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of Permission">
                </div>

                <div class="form-group col-md-6">
                  <label for="guard_name"> Guard Name</label>
                  <select class="form-select form-select-sm" name="guard_name" style="width: 100%;"
                        id="guard_name" aria-label=".form-select-sm example">
                       <option value="admin">Admin </option>
                       <option value="author">Author </option>

                    </select>
               </div>
           </div>


       </div>

              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
                <a href="{{ route('permissions.index') }}" type="submit" class="btn btn-success">Go Back</a>

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
        formData.append('guard_name',document.getElementById('guard_name').value);

        store('/cms/admin/permissions' , formData)
    }
    </script>

@endsection
