@extends("layouts.app")

@section("content")
  <div class="container">

    @if(session('status'))

      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

    @endif

    <form method="post" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <label class="mb-3 h3 fs-2 fw-bold text-light">EDIT YOUR ARTICLE</label>

      <div class="mb-3">
        <input type="file" name="article_photo" class="form-control">
      </div>

      <div class="mb-3">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value= "{{$article->title}}" class="form-control">
      </div>

      <div class="mb-3">
        <label for="myeditor">Body</label>
        <textarea id="myeditor" name="body" class="form-control">{!!$article->body!!}</textarea>
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

        <select id="category"  name="category_id" class="form-select">

          @foreach ($categories as $category)
            <option value="{{ $category->id }}">
              {{ $category->name }}
            </option>
          @endforeach

        </select>

      </div>

      <input type="submit" value="Save" class="btn btn-info">

      <a class="btn btn-dark"
          href="{{ url("/articles/detail/$article->id") }}">
          Cancel
      </a>

    </form>
  @endsection
