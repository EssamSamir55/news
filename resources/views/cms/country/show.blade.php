@extends('cms.parent')

@section('title', 'Show Country')
@section('main-title', 'Show Country')
@section('sub-title', 'Show Country')


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
                <h3 class="card-title">Show Country</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Country name</label>
                    <input disabled type="text" class="form-control" id="name"
                   value="{{ $countries->name }}" name="name" placeholder="Enter Name of Country ">
                  </div>
                  <div class="form-group">
                    <label for="code">Country Code</label>
                    <input disabled type="text" class="form-control" id="code" name="code"
                    value="{{ $countries->code }}" placeholder="Enter Code of Country">
                  </div>

                  <div class="btns py-3">
                    <a href="{{ route('countries.index') }}" type="submit" class="btn btn-info">Go Back</a>
                    </div>

                </div>

              </form>
            </div>
            <!-- /.card -->



          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

@endsection

@section('scripts')

@endsection
