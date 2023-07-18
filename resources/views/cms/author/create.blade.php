@extends('cms.parent')

@section('title', 'Create Author')
@section('main-title', 'Create Author')
@section('sub-title', 'Create Author')


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
                <h3 class="card-title">Create New Author</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="p-3">
                <div class="">
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label>Role Name</label>
                            <select class="form-control select2" id="role_id" name="role_id" style="width: 100%;">
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                <div class="row ">
                <div class="form-group col-md-6">
                <label for="firstname">First Name of Author</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter First Name of Author ">
                </div>
                <div class="form-group col-md-6">
                <label for="lastname">Last Name of Author</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name of Author">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email">
                </div>
                <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Mobile">
            </div>
            <div class="form-group col-md-6">
            <label for="date">Date Of Birth</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Enter Your Date">
            </div>
    </div>



<div class="row">
    <div class="form-group ">
    <label for="gender">Gender</label>
    <select class="form-select form-select-sm" name="gender" id="gender" aria-label=".form-select-sm example">
        <option value="male">Male</option>
        <option value="female">FeMale</option>
    </select>
    </div>
    <div class="form-group ">
        <label for="status">Status</label>
        <select class="form-select form-select-sm" name="status" id="status" aria-label=".form-select-sm example">
        <option value="active">Active</option>
        <option value="inactive" selected>InActive</option>
        </select>
    </div>

</div>

<div class="row">
        <div class="form-group col-md-6">
        <label for='city_id'>City Name</label>
        <select class="form-control select2" id="city_id" name="city_id">
        @foreach ($cities as $city )
        <option value="{{ $city->id }}">{{ $city->name }}</option>
        @endforeach

</select>
</div>
    <div class="form-group col-md-6">
        <label for="image">Choose Image</label>
        <input type="file" class="form-control" id="image" name="image" placeholder="Choose Image">
    </div>

</div>

                <!-- /.card-body -->

                <div class="card-footer bg-white">
                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
                <a href="{{ route('authors.index') }}" type="submit" class="btn btn-info">Go Back</a>

                </div>
                </div>
            </form>
            </div>
            <!-- /.card -->
        </div>
        <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>

@endsection

@section('scripts')

<script>
    function performStore() {
        let formData = new FormData();
        formData.append('firstname',document.getElementById('firstname').value);
        formData.append('lastname',document.getElementById('lastname').value);
        formData.append('email',document.getElementById('email').value);
        formData.append('password',document.getElementById('password').value);
        formData.append('mobile',document.getElementById('mobile').value);
        formData.append('date',document.getElementById('date').value);
        formData.append('gender',document.getElementById('gender').value);
        formData.append('status',document.getElementById('status').value);
        formData.append('city_id',document.getElementById('city_id').value);
        formData.append('role_id',document.getElementById('role_id').value);
        formData.append('image',document.getElementById('image').files[0]);

        store('/cms/admin/authors' , formData)
    }
</script>

@endsection


