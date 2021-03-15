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

		    <div class="form-row mt-5">
			<div class="form-group col-md-6">
			    <label for="inputEmail">Email</label>
			    <input type="email" name="email" class="form-control" id="inputEmail"
				   placeholder=	"{{ $club->admin()->email }}">
			</div>
			<div class="form-group col-md-6">
			    <label for="inputPassword4">Password</label>
			    <input type="password" class="form-control" id="inputPassword4" placeholder="">
			</div>
		    </div>
		    <div class="form-group">
			<label for="inputAddress">Address</label>
			<input type="text" name="address1" class="form-control" id="inputAddress" 
			       placeholder="{{ $club->admin()->contact->address->address1 }}">
		    </div>
		    <div class="form-group">
			<label for="inputAddress2">Address 2</label>
			<input type="text" name="address2" class="form-control" id="inputAddress2"
			       placeholder="{{ $club->admin()->contact->address->address2 }}">
		    </div>
		    <div class="form-row">
			<div class="form-group col-md-4">
			    <label for="inputCity">City</label>
			    <input type="text" name="city" class="form-control"  id="inputCity"
				   placeholder="{{ $club->admin()->contact->address->city }}">
			</div>
			<div class="form-group col-md-3">
			    <label for="inputState">State</label>
			    <select id="inputState" name="state" class="form-control">
				<option selected> {{ $club->admin()->contact->address->state->name }} </option>
				@foreach ($states as $state)
				    <option value="{{ $state->id }}">{{ $state->name }}</option>
				@endforeach
			    </select>
			</div>
			
			<div class="form-group col-md-3">
			    <label for="inputCountry">Country</label>
			    <select id="inputCountry" name="country" class="form-control">
				<option selected> {{ $club->admin()->contact->address->country->name }} </option>
				@foreach ($countries as $country)
				    <option value="{{ $country->id }}">{{ $country->name }}</option>
				@endforeach
			    </select>
			</div>
			
			<div class="form-group col-md-2">
			    <label for="inputZip">Zip</label>
			    <input type="text" class="form-control" id="inputZip">
			</div>
		    </div>
		    
		    
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-primary">Update Club Information</button>
		    </div>

		</form>

	    </div> <!-- class-body -->
	</div>
    </div>

@endsection
