@extends('layouts.app')

@section('content')
<div class="container" >

    @if(session('info'))

      <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

    @endif

    {{ $articles->links() }}  <!--ဒီMethod က စာမျက်နှာ ခွဲပြတဲ့အခါ နောက်စာမျက်နှာတွေကို သွားလို့ရတဲ့ Pagination Links တွေကိုထုတ်ပေးတဲ့ Method ပါ။-->

    @foreach($articles as $article)

    <div class="card mb-2">

      <div class="card-body">

        <h3 class="card-title fw-bold">
          {{ $article->title }}
        </h3>

        <div class="card-subtitle mb-2 text-muted small">
            <span class="text-muted small float-end">{{ $article->created_at->diffForHumans() }}</span>
            By <b class="fs-4 text-success">{{$article->user->name}}</b><br>
            Category:  <b class="text-dark">{{ $category->name }}</b>

        </div>

        <div class="card-body ">
            @if($article->article_photo)
            <img
              class="img-thumbnail  me-3 float-start" width="200" height="500" style="vertical-align: middle"
              src="{{asset("storage/$article->article_photo")}}"
              alt="{{$article->name}}" >
            @endif
            <div class="text-truncate">
                {!!$article->body !!}
            </div>
        </div> <!-- text truncate  နဲ့ စာတွေကိုဖျက်ချ -->

        <a class="btn btn-secondary"
          href="{{ url("/articles/detail/$article->id") }}">
          Read More ...
        </a>

      </div>

    </div>

    @endforeach



  </div>
@endsection
