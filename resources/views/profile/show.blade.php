@extends('layouts.app')



@section('content')

<div class="container">
    <div class="row">

        <div class="col-lg-6 margin-tb">

            <div class="pull-left">

<div class="back-btn">

                <a class="btn btn-primary" href="{{ route('profile.index') }}"> Back</a>

            </div>

            </div>



        </div>

    </div>

      <div class="card">
        <div class="card-header">
            <h2> عرض الملف الشخصي </h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <img src="@if (isset($profile->image))
                    {{asset('storage/image/profile').'/' .$profile->image}} @else {{asset('storage/image/profile/defaut.png')}} @endif "
                    class=" img-thumbnail card-img-top img-fluid profile-img" alt="{{$profile->title}}">
                </div>
                <div class="col-md-8">
                    <h5 class="card-title">{{$profile->user->name }}</h5>
                    <p class="card-text">{{ $profile->body }}</p>
                    <p class="card-text"><small class="text-muted">اخر تحديث  :  {{$profile->updated_at->diffForHumans()}}</small></p>
                </div>
            </div>


        </div>
      </div>
</div>

@endsection
