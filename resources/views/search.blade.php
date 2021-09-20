@extends('layouts.front')
@include('layouts.includes.navbar')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.includes.sidebar')
        </div>
        <div class="col-md-9">
            @if($posts->isNotEmpty())
            <div class="row">

                    @foreach ($posts as $post)
                    <div class="col-md-3 gab">
                        <div class="post-list">
                            <a class="btn btn-secondary btn-sm" href="{{ route('single', $post->id)}}"
                                rel="noopener noreferrer">.
                            <p>{{ $post->title }}</p>
                            <img src="@if (isset($post->image))
                                {{asset('storage/image/posts').'/' .$post->image}} @else {{asset('storage/image/posts/defaut.png')}} @endif "
                                 class=" img-thumbnail card-img-top img-fluid search-img" alt="{{$post->title}}"></a>
                        </div>
                    </div>
                    @endforeach
                    {{ $posts->links('vendor.pagination.custom') }}
            </div>
            @else
                <div class="alert alert-danger">
                    <h2>No posts found</h2>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
