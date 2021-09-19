@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">
                     @lang('site.add new post')
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <form action=" {{ isset($posts) ? route('post.update', $posts->id) : route('post.store')}}" method='POST' enctype="multipart/form-data">
                        @csrf
                        @if(isset($posts)) @method('PUT') @endif
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">@lang('site.Title')</span>
                            <input type="text" class="form-control" name="title" value = "{{ isset($posts) ? $posts->title : " " }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">@lang('site.img')</span>
                            <input type="file" class="form-control" name="photo" value = "{{ isset($posts) ? $posts->image : " " }}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group" id="editor">
                            <span class="input-group-text">@lang('site.content')</span>
                            <textarea class="form-control body" id="content" name="body" aria-label="With textarea">
                                {!! isset($posts) ? $posts->content : " " !!}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm"> @if($posts)  @lang('site.update')  @else  @lang('site.save')  @endif</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

