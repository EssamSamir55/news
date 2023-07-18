@extends('cms.parent')

@section('title' , 'Edit Admin')

@section('main-title' , 'Edit Admin')

@section('sub-title' , 'Edit Admin')

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
              <h3 class="card-title">Edit New Admin</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="p-3">

              <div class="row">

                <div class="form-group col-md-6">
                    <label>Role Name</label>
                    <select class="form-control select2" id="role_id" name="role_id" style="width: 100%;">
                    @foreach($roles as $role)
                      {{-- <option value="{{ $role->id }}">{{ $role->name }}</option> --}}
                      <option @if ($role->id == $admins->role_id) selected @endif value="{{ $role->id }}">
                        {{ $role->name }}</option>
                      @endforeach
                    </select>
                  </div>
            </div>

                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="firstname">First Name of Admin</label>
                      <input type="text" class="form-control" id="firstname" name="firstname"
                      value="{{$admins->user->firstname}}" placeholder="Enter First Name of Admin">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="lastname">Last Name of Admin</label>
                      <input type="text" class="form-control" id="lastname" name="lastname"
                      value="{{$admins->user->lastname}}" placeholder="Enter Last Name of Admin">
                    </div>
                  </div>

                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="email"> Email</label>
                      <input type="email" class="form-control" id="email" name="email"
                      value="{{$admins->email}}" placeholder="Enter Your Email">
                    </div>

                    {{-- <div class="form-group col-md-6">
                      <label for="password"> Password</label>
                      <input type="password" class="form-control" id="password" name="password"
                      value="{{ $admins->password }}" placeholder="Enter Password">
                    </div> --}}
                  </div>

                  <div class="row">

                    <div class="form-group col-md-6">
                      <label for="mobile"> Mobile</label>
                      <input type="text" class="form-control" id="mobile" name="mobile"
                      value="{{$admins->user->mobile}}" placeholder="Enter Your Mobile">
                    </div>

                    <div class="form-group col-md-6">
                      <label for="date"> Date of Birth</label>
                      <input type="date" class="form-control" id="date" name="date"
                      value="{{$admins->user->date}}" placeholder="Enter Your Date of Birth">
                    </div>
                  </div>

                  <div class="row">

                    <div class="form-group col-md-6">
                        <label for="gender"> Gender</label>
                        <select class="form-select form-select-sm" name="gender" style="width: 100%;"
                              id="gender" aria-label=".form-select-sm example">
                              <option selected> {{ $admins->user->gender }} </option>

                              <option value="male">Male</option>
                             <option value="female">FeMale </option>
                          </select>
                 </div>

                    <div class="form-group col-md-6">
                           <label for="status"> Status</label>
                           <select class="form-select form-select-sm" name="status" style="width: 100%;"
                                 id="status" aria-label=".form-select-sm example">
                                 <option selected> {{ $admins->user->status }} </option>
                                 <option value="active">Active </option>
                                <option value="inactive">InActive </option>
                             </select>
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-md-6">
                        <label>City Name</label>
                        <select class="form-control select2" id="city_id" name="city_id" style="width: 100%;">
                        @foreach($cities as $city)
                          {{-- <option value="{{ $city->id }}">{{ $city->name }}</option> --}}

                          <option @if ($city->id == $admins->user->city_id) selected @endif value="{{ $city->id }}">
                            {{ $city->name }}</option>
                        @endforeach
                        </select>
                      </div>

                    <div class="form-group col-md-6">
                      <label for="image"> Chosse Image</label>
                      <input type="file" class="form-control" id="image" name="image" placeholder="Choose Image">
                    </div>
                </div>

              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="performUpdate({{$admins->id}})" class="btn btn-primary">Store</button>
                <a href="{{ route('admins.index') }}" type="submit" class="btn btn-success">Go Back</a>

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
      formData.append('firstname',document.getElementById('firstname').value);
      formData.append('lastname',document.getElementById('lastname').value);
      formData.append('email',document.getElementById('email').value);
    //   formData.append('password',document.getElementById('password').value);
      formData.append('mobile',document.getElementById('mobile').value);
      formData.append('date',document.getElementById('date').value);
      formData.append('gender',document.getElementById('gender').value);
      formData.append('status',document.getElementById('status').value);
      formData.append('city_id',document.getElementById('city_id').value);
      formData.append('role_id',document.getElementById('role_id').value);
      formData.append('image',document.getElementById('image').files[0]);

      storeRoute('/cms/admin/admins_update/'+id , formData)

  }
  </script>
@endsection
