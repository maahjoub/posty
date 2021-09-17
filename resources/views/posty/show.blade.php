@extends('layouts.app')
@section('content')
    <div class="container al-ju">
        <div class="row">
            <div class="col-md-4">
                sidebar
            </div>
            @foreach ($posts as $post)
                <div class="col-md-8">
                    <h3>{{ $post->title}}</h3>
                    <p class="lead">
                        {!! $post->content !!}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
