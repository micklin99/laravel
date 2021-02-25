@extends('layouts.fortygoals')

 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>fortygoals Dashboard</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('clubs.create') }}"> Create New Club</a>
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
            <th>Id (ascending)</th>
            <th>Name</th>
            <th>Website</th>
            <th>Subdomain</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($clubs->sortBy('id') as $club)
            <tr>
		<td>{{ $club->id }} </td>
		<td>{{ $club->name }}</td>
		<td>{{ $club->website }}</td>
		<td>{{ $club->subdomain }}</td>
		<td>
                    <form action="{{ route('clubs.destroy',$club->id) }}" method="POST">
			<a class="btn btn-info" href="{{ route('clubs.show',$club->id) }}">
			    Show</a>
			<a class="btn btn-primary" href="{{ route('clubs.edit',$club->id) }}">
			    Edit</a>
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-danger">Delete</button>
                    </form>
		</td>
            </tr>
        @endforeach
    </table>

    {!! $clubs->links() !!}

@endsection
