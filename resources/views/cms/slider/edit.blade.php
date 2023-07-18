@extends('cms.parent')

@section('title' , 'Edit Slider')

@section('main-title' , 'Edit Slider')

@section('sub-title' , 'Edit Slider')

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
              <h3 class="card-title">Edit New sliders</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">

                <div class="form-group col-md-6">

                  <label for="title">sliders Name</label>
                  <input type="text" class="form-control" id="title" name="title" value="{{$sliders->title}}" placeholder="Enter Name of sliders">
                </div>
           </div>

           <div class="row">
                <div class="form-group col-md-1">
                    <label for="image">Choose image</label>
                    <input type="file" class="form-control" id="image" name="image" >


               </div>
               </div>

           <div class="row">

           <div class="col-md-12">
             <div class="form-group">
                 <label for="description"> Description of sliders</label>
                     <textarea class="form-control" style="resize: none;" id="description" name="description" rows="4"
                     placeholder="Enter Description of sliders " cols="50">{{$sliders->description}}</textarea>
             </div>
         </div>
       </div>

              <!-- /.card-body -->

              <div class="card-footer bg-white">
                <button type="button" onclick="performUpdate({{ $sliders->id }})" class="btn btn-primary">Store</button>
                <a href="{{ route('sliders.index') }}" type="submit" class="btn btn-success">Go Back</a>

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
        formData.append('title',document.getElementById('title').value);
        formData.append('image',document.getElementById('image').files[0]);
        formData.append('description',document.getElementById('description').value);
        store('/cms/admin/sliders_update/' + id , formData)
    }
    </script>

@endsection
