@extends('layouts.front')
@include('layouts.includes.navbar')
@section('content')
@include('layouts.includes.sidebar')
   <div class="container al-ju">
        <div class="row">
            <div class="col-md-4">
                <div class="alert alert-success" style="display:none"></div>
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
                        <span class="likes" id="total-like">{{ $posts->likes->count()}} {{ Str::plural('like', $posts->likes->count())}} </span>
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
                        user_id : {{auth()->user()->id}}
                    },
                    success: function(result){
                    getSelectedRow = function(val) {
                    db.transaction(function(transaction) {
                        transaction.executeSql('SELECT count(*) FROM likes where post_id = ?;',[parseInt(val)], selectedRowValues, errorHandler);

                    });
                    };
                    selectedRowValues = function(transaction,results) {
                    for(var i = 0; i < results.rows.length; i++){
                        var row = results.rows.item(i);
                        alert(row['post_id']);
                        alert(row['post_id']);
                    }
                    };
                        jQuery('.alert').show();
                        jQuery('.alert').html(result.success);
                    }});



                 });





                jQuery("#unsaveLike").click(function(e){
                var id = $(this).data("id");
                e.preventDefault();
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
                    success: function (){
                        console.log("it Works");
                    }
                });

            });
        });
    </script>
@endsection

