@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>profile</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('profile.create') }}"> Create New profile</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($profiles as $profile)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $profile->user->name }}</td>
	        <td>{{ $profile->body }}</td>
	        <td>
                <form action="{{ route('profile.destroy',$profile->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('profile.show',$profile->id) }}">Show</a>
                    @can('product-edit')
                    <a class="btn btn-primary" href="{{ route('profile.edit',$profile->id) }}">Edit</a>
                    @endcan

                    @csrf
                    @method('DELETE')
                    @can('product-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
</div>
    {!! $profiles->links() !!}

@endsection
