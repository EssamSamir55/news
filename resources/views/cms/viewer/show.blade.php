@extends('cms.parent')

@section('title', 'Show Viewer')
@section('main-title', 'Show Viewer')
@section('sub-title', 'Show Viewer')


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
                <h3 class="card-title">Show Viewer</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="mt-5">
                <div class="container">

                <div class="row ">
                <div class="form-group col-md-6">
                <label for="firstname">First Name of Viewer</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $viewers->user->firstname}}" placeholder="Enter First Name of Viewer " disabled>
                </div>
                <div class="form-group col-md-6">
                <label for="lastname">Last Name of Viewer</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $viewers->user->lastname}}"  placeholder="Enter Last Name of Viewer" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" value="{{ $viewers->email}}" id="email" name="email" placeholder="Enter Your Email" disabled>
                </div>
                {{-- <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                </div> --}}
                <div class="form-group col-md-6">
                    <label for='city_id'>City Name</label>
                    <select class="form-control select2" id="city_id" name="city_id" disabled>
                        <option selected>{{ $viewers->user->city->name ?? "" }}</option>


                    {{-- @foreach ($cities as $city )
                    <option @if ($city->id == $viewers->user->city_id) selected @endif value='{{ $city->id }}'>{{ $city->name }}</option>
                    @endforeach --}}

            </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
            <label for="mobile">Mobile</label>
            <input disabled type="text" class="form-control" id="mobile" name="mobile" value="{{ $viewers->user->mobile}}"  placeholder="Enter Your Mobile">
            </div>
            <div class="form-group col-md-6">
            <label for="date">Date Of Birth</label>
            <input disabled type="date" class="form-control" id="date" name="date" value="{{ $viewers->user->date }}"  placeholder="Enter Your Date">
            </div>
    </div>


<div class="row">
    <div class="form-group col-md-6">
    <label for="gender">Gender</label>
    <select disabled class="form-select form-select-sm" name="gender" id="gender" aria-label=".form-select-sm example">
        <option selected>{{ $viewers->user->gender}}</option>
        <option value="male">Male</option>
        <option value="female">FeMale</option>
    </select>
    </div>
    <div class="form-group col-md-6">
        <label for="status">Status</label>
        <select disabled class="form-select form-select-sm" name="status" id="status" aria-label=".form-select-sm example">
        <option selected>{{ $viewers->user->status}}</option>
        <option value="active">Active</option>
        <option value="inactive">InActive</option>
        </select>
    </div>
</div>

<div class="row">



    <div class="form-group col-md-6">
        <label for="image">Choose Image</label>
        <input type="file" class="form-control" id="image" name="image" value="{{ $viewers->user->image }}" placeholder="Choose Image">
    </div>

</div>
<div class="btns py-3">
    <a href="{{ route('viewers.index') }}" type="submit" class="btn btn-info">Go Back</a>
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
    function performUpdate(id) {
        let formData = new FormData();
        formData.append('firstname',document.getElementById('firstname').value);
        formData.append('lastname',document.getElementById('lastname').value);
        formData.append('email',document.getElementById('email').value);
        // formData.append('password',document.getElementById('password').value);
        formData.append('mobile',document.getElementById('mobile').value);
        formData.append('date',document.getElementById('date').value);
        formData.append('gender',document.getElementById('gender').value);
        formData.append('status',document.getElementById('status').value);
        formData.append('city_id',document.getElementById('city_id').value);
        formData.append('image',document.getElementById('image').files[0]);

        storeRoute('/cms/admin/viewers_update/'+id  , formData)
    }
</script>

@endsection


