@extends('layouts.app')

@section('content')

    <div class="container">

        @if($user->profile_photo)
        <img
          class="img-thumbnail m-3"
          src="{{asset("storage/$user->profile_photo")}}"
          alt="{{$user->name}}" width="200" height="500">
        @endif

        <form method="POST" enctype="multipart/form-data" class="mb-5">
            @csrf

            <div class="input-group mb-3">
                <input type="file" name="profile_photo" class="form-control">
                <button type="submit" class="btn btn-primary">Upload Photo</button>
            </div>

        </form>

        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <ul class="list-group" style="position: sticky; top: 20px;">
                        <li class="list-group-item">Name: {{$user->name}}</li>
                        <li class="list-group-item">Email: {{$user->email}}</li>
                        <li class="list-group-item">Started at : {{$user->created_at->format('d M Y')}}</li>

                    </ul>
                </div>
                <div class="col-lg-8 mb-4">
                    <div class="container">
                        {{ $userPosts->links()}}
                        @foreach($userPosts as $article)
                            <div class="card mb-2">

                            <div class="card-body">
                                @if($article->article_photo)
                                <img
                                  class="rounded  me-3 float-start" width="200" height="100" style="vertical-align: middle"
                                  src="{{asset("storage/$article->article_photo")}}"
                                  alt="{{$article->name}}" >
                                @endif

                                <h3 class="card-title fw-bold">
                                    {{ $article->title }}
                                </h3>

                                <div class="card-subtitle mb-2 text-muted small">
                                    By <b class="fs-4 text-success">{{$article->user->name}}</b><br>
                                    Category:  <b class="text-dark">{{ $article->category->name }}</b>
                                    <span class="text-muted small float-end">{{ $article->created_at->diffForHumans() }}</span>
                                </div>

                                <p class="card-body ">
                                    <div class="text-truncate">
                                        {!!$article->body !!}
                                    </div>
                                </p> <!-- text truncate  နဲ့ စာတွေကိုဖျက်ချ -->

                                <a class="text-danger" style="text-decoration: none"
                                    href="{{ url("/articles/detail/$article->id") }}">
                                    Read More >>>
                                </a>

                            </div>

                        </div>


                        @endforeach
                    </div>
                </div>
            </div>
        </div>












    </div>



@endsection

{{--
             --}}
