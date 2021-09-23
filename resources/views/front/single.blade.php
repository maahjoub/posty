@extends('layouts.front')
@include('layouts.includes.navbar')
@section('content')
@include('layouts.includes.sidebar')
   <div class="container al-ju">
        <div class="row">
            <div class="col-md-4">    
            </div>
            <div class="col-md-8 post-show">
            
            <div class="alert alert-success msg-btn" style="display:none"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>
                <h3>{{ $posts->title}}</h3>
                <img src="@if (isset($post->image))

                {{asset('storage/image/posts').'/' .$posts->image}} @else {{asset('storage/image/posts/defaut.png')}} @endif "
                 class=" img-thumbnail card-img-top img-fluid post-img" alt="{{$posts->title}}">
                 <p class="lead">
                    {!! $posts->content !!}
                </p>
                <div class="social">
                    <ul class="soc-links">
                        <span class="likes" id="total-like">{{ $posts->likes->count()}} {{ Str::plural('like', $posts->likes->count())}} </span>
                        @auth
                            <form action=""  class="mr-1">
                                @csrf
                            <li>
                                    <button id="saveLike"  @if ($posts->likedBy(auth()->user()))disabled="disabled"
                                    @endif><i class="bi bi-hand-thumbs-up-fill"></i></button>
                                </li>
                            </form>
                            {{-- {{ route('post.unlike', $posts->id)}} --}}
                            <form action="" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <li><button  id="unsaveLike"  data-id="{{ $posts->id }}" @if (!$posts->likedBy(auth()->user()))disabled="disabled"
                                @endif><i class="bi bi-hand-thumbs-down-fill"></i></button></li>
                            </form>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.includes.footer')
@endsection

@section('scripts')
    <script>
            jQuery(document).ready(function(e){
                jQuery('#saveLike').click(function(e){
                e.preventDefault();
                let spanCount = document.getElementById('total-like');
                let saveLike = document.getElementById('saveLike');
                let unsaveLike = document.getElementById('unsaveLike');
                let postlikecount = {{ $posts->likes->count()}} + 1 ;
                postlikecount += '{{ Str::plural('like', $posts->likes->count())}}';
                spanCount.innerHTML = postlikecount ;
                saveLike.setAttribute("disabled", "disabled");
                unsaveLike.setAttribute("disabled", "none");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    jQuery.ajax({
                    url: "{{ route('post.like', $posts->id)}}",
                    method: 'post',
                    processData: false,
                    cache: false,
                    contentType: false,
                    data: {
                         
                        
                    },
                    success: function(data){
                        if (data.status == true) {
                        jQuery('.alert').show();
                        jQuery('.alert').html(data.msg);
                        }
                    }});
                 });
                jQuery("#unsaveLike").click(function(e){
                var id = $(this).data("id");
                e.preventDefault();
                let spanCount = document.getElementById('total-like');
                let unlike = document.getElementById('unsaveLike');
                let savelike = document.getElementById('saveLike');
                let postlikecount = {{ $posts->likes->count()}} - 1 ;
                postlikecount += '{{ Str::plural('like', $posts->likes->count())}}';
                spanCount.innerHTML = postlikecount ;
                unlike.setAttribute("disabled", "disabled");
                savelike.setAttribute("disabled", "none");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: "{{ route('post.like', $posts->id)}}",
                    type: 'DELETE',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: {
                        "post_id": id,
                    },
                    success: function (data){
                        if (data.status == true) {
                        jQuery('.alert').show();
                        jQuery('.alert').html(data.msg);
                        }
                        
                    }
                });

            });
        });
    </script>
@endsection

