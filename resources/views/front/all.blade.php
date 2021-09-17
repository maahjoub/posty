@extends('layouts.front')
@include('layouts.includes.navbar')
@section('content')
    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4">
                    <h3>{{ $post->title}}</h3>
                    <p class="lead">
                        {!! Str::words($post->content, 20, '' ) !!}
                         <a class="btn btn-primary btn-sm" href="{{ route('single', $post->id )}}"
                            rel="noopener noreferrer">@lang('site.more') ....</a>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
