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
                <div class="social">
                    <ul class="soc-links">
                        <span class="likes">{{ $posts->likes->count()}} {{ Str::plural('like', $posts->likes->count())}} </span>
                        <form action="{{ route('post.like', $posts->id)}}" method="POST" class="mr-1">
                            @csrf
                           <li>
                                <button type="submit" @if ($posts->likedBy(auth()->user()))disabled="disabled"
                                @endif><i class="bi bi-hand-thumbs-up-fill"></i></button>
                            </li>
                        </form>
                        {{-- {{ route('post.unlike', $posts->id)}} --}}
                        <form action="{{ route('post.like', $posts->id)}}" method="POST" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <li><button  type="submit"  @if (!$posts->likedBy(auth()->user()))disabled="disabled"
                            @endif><i class="bi bi-hand-thumbs-down-fill"></i></button></li>
                        </form>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.includes.footer')
@endsection

