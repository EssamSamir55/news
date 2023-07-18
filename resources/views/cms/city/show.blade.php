@extends('cms.parent')

@section('title', 'Show City')
@section('main-title', 'Show City')
@section('sub-title', 'Show City')


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
                <h3 class="card-title">Show City</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
                <div class="row w-50">
                    <div class="card-body">
                        <div class="form-group">
                <label for='country_id'>Country Name</label>
                <select disabled class="form-control select2" id="country_id" name="country_id">
                <option selected>{{ $cities->country->name ?? "" }}</option>


                </select>
                </div>
                    </div>

                </div>


                  <div class="row w-50">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">City name</label>
                    <input disabled type="text" class="form-control" id="name" name="name" value="{{ $cities->name }}" placeholder="Enter Name of City ">
                  </div>
                  <div class="form-group">
                    <label for="street">City street</label>
                    <input disabled type="text" class="form-control" id="street" name="street" value="{{ $cities->street }}" placeholder="Enter street of City">
                  </div>
                </div>
                <div class="btns py-3">
                    <a href="{{ route('cities.index') }}" type="submit" class="btn btn-info">Go Back</a>
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
    function performUpdate(id){
        let formData = new FormData();
        formData.append('name',document.getElementById('name').value);
        formData.append('street',document.getElementById('street').value);
        formData.append('country_id',document.getElementById('country_id').value);

        storeRoute('/cms/admin/cities_update/' + id , formData);// اذا كان بحتاج id بختم بسلاش

    }
</script>
@endsection


