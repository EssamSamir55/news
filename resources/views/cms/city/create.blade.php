@extends('cms.parent')

@section('title', 'Create City')
@section('main-title', 'Create City')
@section('sub-title', 'Create City')


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
                <h3 class="card-title">Create New City</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="row w-50">
                    <div class="card-body">
                          <div class="form-group">
                  <label for='country_id'>Country Name</label>
                  <select class="form-control select2" id="country_id" name="country_id">

                    @foreach ($countries as $country )
                    <option value="{{ $country->id }}">{{ $country->name }}</option>


                    @endforeach

                </select>
                </div>
                    </div>

                </div>


                <div class="row w-50">
                <div class="card-body">
                <div class="form-group">
                    <label for="name">City name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name of City ">
                </div>
                <div class="form-group">
                    <label for="street">City street</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Enter street of City">
                  </div>
                </div>
            </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
                  <a href="{{ route('cities.index') }}" type="submit" class="btn btn-info">Go Back</a>

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
        formData.append('name',document.getElementById('name').value);
        formData.append('street',document.getElementById('street').value);
        formData.append('country_id',document.getElementById('country_id').value);

        store('/cms/admin/cities' , formData)
    }
</script>

@endsection


