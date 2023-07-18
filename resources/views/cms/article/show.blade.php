@extends('cms.parent')

@section('title' , 'Show Article')

@section('main-title' , 'Show Article')

@section('sub-title' , 'Show Article')

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
              <h3 class="card-title">Show Article</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">

               <div class="row">

                    <div class="form-group col-md-6">
                        <label>Author Name</label>
                        <select disabled class="form-control select2" id="author_id" name="author_id" style="width: 100%;">
                        @foreach($authors as $author)

                         <option @if ($author->id == $articles->author_id) selected @endif value="{{ $author->id }}">
                            {{ $author->email }}</option>
                        @endforeach
                        </select>
                      </div>

                            <div class="form-group col-md-6">
                        <label>Category Name</label>
                        <select disabled class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                        @foreach($categories as $category)

                         <option @if ($category->id == $articles->category_id) selected @endif value="{{ $category->id }}">
                            {{ $category->name }}</option>

                        @endforeach
                        </select>
                      </div>
                   </div>


                <div class="row">

                <div class="form-group col-md-6">

                  <label for="title">Article Title</label>
                  <input disabled type="text" class="form-control" id="title" name="title"
                  value="{{ $articles->title }}" placeholder="Enter Name of Article">
                </div>

                   <div class="form-group col-md-6">

                  <label for="image">Article Image</label>
                  <input disabled type="file" class="form-control" id="image" name="image" placeholder="Choose Image for Article">
                </div>

           </div>

           <div class="row">

           <div class="col-md-12">
             <div class="form-group">
                 <label for="short_description"> Description of Article</label>
                     <textarea disabled class="form-control" style="resize: none;" id="short_description" name="short_description" rows="4"
                     placeholder="Enter Short Description of Article " cols="50">{{ $articles->short_description }}</textarea>
             </div>
         </div>
       </div>

        <div class="row">

           <div class="col-md-12">
             <div class="form-group">
                 <label for="full_description"> Description of Article</label>
                     <textarea disabled class="form-control" style="resize: none;" id="full_description" name="full_description" rows="4"
                     placeholder="Enter Full Description of Article " cols="50">{{ $articles->full_description }}</textarea>
             </div>
         </div>
         <div class="btns py-3">
            <a href="{{ route('articles.index') }}" type="submit" class="btn btn-info">Go Back</a>
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
        formData.append('title',document.getElementById('title').value);
        formData.append('short_description',document.getElementById('short_description').value);
        formData.append('full_description',document.getElementById('full_description').value);
        formData.append('category_id',document.getElementById('category_id').value);
        formData.append('author_id',document.getElementById('author_id').value);
        formData.append('image',document.getElementById('image').files[0]);

        storeRoute('/cms/admin/articles_update/'+id , formData)
    }
    </script>

@endsection
