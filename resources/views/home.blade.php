@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

                <div class="card-footer">
                  <a class="btn btn-primary" href="{{ url('/articles') }}">Continue To HomePage </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
