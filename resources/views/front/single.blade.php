@extends('layouts.front')
@include('layouts.includes.navbar')
@section('content')
@include('layouts.includes.sidebar')
   <div class="container al-ju">
        <div class="row">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-8 post-show">
                <h3>{{ $posts->title}}</h3>
                <img src="@if (isset($post->image))

                {{asset('storage/image/posts').'/' .$posts->image}} @else {{asset('storage/image/posts/defaut.png')}} @endif "
                 class=" img-thumbnail card-img-top img-fluid post-img" alt="{{$posts->title}}">
                 <p class="lead">
                    {!! $posts->content !!}
                </p>
            </div>
        </div>
    </div>
    @include('layouts.includes.footer')
@endsection

