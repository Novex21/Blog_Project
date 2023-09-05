@extends('layouts.app')

@section('content')
  <div class="container">

    @if($errors->any())
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <ol>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ol>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif


    <form method="post" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <input type="file" name="article_photo" class="form-control">
      </div>
      <div class="mb-3">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" class="form-control">
      </div>

      <div class="mb-3">
        <label for="myeditor">Body</label>
        <textarea id="myeditor" name="body" class="form-control"></textarea>
        <script>
            tinymce.init({
                selector: 'textarea#myeditor', // Replace this CSS selector to match the placeholder element for TinyMCE
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
            });
        </script>
      </div>

      <div class="mb-3">
        <label for="category">Category</label>
        <select id="category" name="category_id" class="form-select">
          @foreach ($categories as $category)
          <option value="{{ $category->id }}">
            {{ $category->name }}
          </option>
          @endforeach
        </select>
      </div>

      <input type="submit" value="Add Article" class="btn btn-info">

    </form>
  </div>
@endsection
