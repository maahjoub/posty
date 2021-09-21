@extends('layouts.app')
@section('content')
@include('layouts.includes.sidebar')
    <div class="container al-ju">
        <div class="row">
            <div class="col-md-4 mt-5">
                <span class="card-title ">
                    <a class="btn btn-info btn-sm" href="{{ route('post.edit' ,$posts->id) }}"><i class="bi bi-pen-fill"></i></a>
                    <form action="{{ route('post.destroy', $posts->id) }}" method="post" style="display: inline-block">
                       {{ csrf_field() }} {{ method_field('delete') }}
                       <button type="submit" class="btn btn-danger delete btn-sm"><i class="bi bi-trash"></i></button>
                   </form>
               </span>
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
