@extends('fortygoals')

@section('content')
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!---------------- FORM ---------------------->

    <div class="col-12">
	<div class="card mx-3">
	    <div class="card-header">
		<div class="row">
		    <div class="col-9">
			<h3 class="card-title">{{ $club->name }} </h3>
		    </div>
		    <div class="col-3">
			<a class="btn btn-success" href="{{ route('clubs.index') }}"> View All Clubs </a>
		    </div>
		</div>
	    </div>
	    <!-- /.card-header -->
	    <div class="card-body">
		

		<form action="{{ route('clubs.update', [$club->id]) }}" method="POST">
		    @csrf
		    @method('POST')

		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Club Name</label>
			<div class="col-sm-9">
			    <input type="text" name="name" class="form-control" value="{{ $club->name }}" placeholder="Name">
			</div>
		    </div>

		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Website</label>
			<div class="col-sm-9">
			    <input type="text" name="website" class="form-control" value="{{ $club->website}}" placeholder="http://www.example.com">
			</div>
		    </div>

		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Subdomain</label>
			<div class="col-sm-9">
			    <input type="text" name="subdomain" class="form-control" value="{{ $club->subdomain}}" placeholder="example">
			</div>
		    </div>

		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Contact First Name</label>
			<div class="col-sm-9">
			    <input type="text" name="firstName" class="form-control"
				   value="{{ $club->admin()->firstName}}">
			</div>
		    </div>

		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Contact Last Name</label>
			<div class="col-sm-9">
			    <input type="text" name="lastName" class="form-control"
				   value="{{ $club->admin()->lastName}}">
			</div>
		    </div>

		    @include('includes.user')		    

		    @include('includes.address')
		    
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-primary">Update Club Information</button>
		    </div>

		</form>

	    </div> <!-- class-body -->
	</div>
    </div>

@endsection
