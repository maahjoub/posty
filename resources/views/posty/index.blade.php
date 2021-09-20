@extends('layouts.app')
@push('style')
	<style type="text/css">
		.my-active span{
			background-color: #5cb85c !important;
			color: white !important;
			border-color: #5cb85c !important;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                sidebar
            </div>
            <div class ="col-md-10">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-4 custom">
                            <div class="card post-card text-center" >
                                <span class="card-title post-title">{{ $post->title}}
                                     <a class="btn btn-info btn-sm" href="{{ route('post.edit' ,$post->id) }}"><i class="bi bi-pen-fill"></i></a>
                                     <form action="{{ route('post.destroy', $post->id) }}" method="post" style="display: inline-block">
                                        {{ csrf_field() }} {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-danger delete btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                </span>
                                <img src="@if (isset($post->image))

                                {{asset('storage/image/posts').'/' .$post->image}} @else {{asset('storage/image/posts/defaut.png')}} @endif "
                                 class=" img-thumbnail card-img-top img-fluid post-img" alt="{{$post->title}}">

                                <div class="card-body">
                                    <p class="card-text">{!! Str::words($post->content, 15, '' ) !!}
                                    </p><a class="btn btn-info" href="{{ route('post.show', $post->id)}}"
                                    rel="noopener noreferrer">@lang('site.more') ....</a>
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
