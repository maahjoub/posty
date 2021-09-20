@extends('layouts.front')
@include('layouts.includes.navbar')
@section('content')
 <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                @include('layouts.includes.sidebar')
            </div>
            <div class ="col-md-9">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-4 custom">
                            <div class="card post-card" >
                                <img src="@if (isset($post->image))
                                {{asset('storage/image/posts').'/' .$post->image}} @else {{asset('storage/image/posts/defaut.png')}} @endif "
                                 class=" img-thumbnail card-img-top img-fluid post-img" alt="{{$post->title}}">
                                <span class=" post-title">
                                    {{ $post->title}}
                                </span>
                                <span class=" post-info">
                                    <span class="user-name">{{ $post->user->name}}</span>
                                    <span class="post-date">{{$post->created_at->diffForHumans()}}</span>
                                </span>
                                <div class="card-body">
                                    <p class="card-text">{!! Str::words($post->content, 29, '' ) !!}
                                    <a class="btn btn-primary btn-sm" href="{{ route('single', $post->id)}}"
                                    rel="noopener noreferrer">@lang('site.more') ....</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{ $posts->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>
    </div>
@endsection
