@extends('layouts.app')
@section('content')
    <div class="container al-ju">
        <div class="row">
            <div class="col-md-4">
                sidebar
            </div>
                <div class="col-md-8 post-show">
                    <h3>{{ $posts->title}}</h3>
                    <img src="{{ asset('storage/image/posts').'/' .$posts->image}}" class=" img-thumbnail card-img-top img-fluid show-img" alt="{{$posts->title}}">
                    <p class="lead">
                        {!! $posts->content !!}
                    </p>
                </div>
        </div>
    </div>
@endsection
