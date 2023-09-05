@extends("layouts.app")

@section("content")
<div class="container">

  @if(session('error'))

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif



  <!--
  For Article section
  -->


  <div class="card mb-2">

    <div class="card-body">

      @auth
        @can('article-edit', $article)
        <a class="float-end me-3" href="{{ url("/articles/update/$article->id")}}">
            <i class="fa-solid fa-pen-to-square fa-lg"></i>
        </a>
        @endcan

        @can('article-delete', $article)
        <a class="float-end me-3" href="{{ url("/articles/delete/$article->id") }}">
            <i class="fa-regular fa-trash-can fa-lg" style="color: #ff0000;"></i>
        </a>
        @endcan

      @endauth

        <h5 class="card-title fs-1">{{ $article->title }}</h5>

        <div class="card-subtitle mb-2 text-muted small">
            By <b class="fs-4 text-success">{{$article->user->name}}</b> <br>
            Category:  <b class="text-dark">{{ $article->category->name }}</b>
            <span class="text-muted small float-end">{{ $article->created_at->diffForHumans() }}</span>
        </div>

        <div class="card-body">
            @if($article->article_photo)
            <img
              class="img-fluid mb-4 mx-auto d-block" width="800" height="300"
              src="{{asset("storage/$article->article_photo")}}"
              alt="{{$article->name}}" >
            @endif
            {!!$article->body !!}
        </div>
    </div>
  </div>

  <!--
  For Comment section
  -->

  <ul class="list-group mb-2">
    <li class="list-group-item active">
      <b>Comments ({{ count($article->comments) }}) </b>
    </li>
    @foreach($article->comments as $comment)
    <li class="list-group-item">
      @auth
        @can('comment-delete', $comment)
        <a href="{{ url("/comments/delete/$comment->id") }}"  class="btn-close float-end"></a>
        @endcan
      @endauth
      {{ $comment->content }}
      <div class="small mt-2">
        By <b class="text-success">{{ $comment->user->name }}</b>
        ({{ $comment->created_at->diffForHumans() }})
      </div>
    </li>
    @endforeach
  </ul>

  <!--
  For New Comments
  -->

 @auth
  <form action="{{ url('/comments/add') }}" method="post">
    @csrf
    <input type="hidden" name="article_id" value="{{ $article->id }}">  <!--Becareful of the type hidden !-->
    <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
    <input type="submit" value="Add Comment" class="btn btn-primary">
  </form>
 @endauth

</div>
@endsection
