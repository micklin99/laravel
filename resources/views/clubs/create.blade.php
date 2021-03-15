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

    <div class="col-12">
	<div class="card mx-3">
	    <div class="card-header">
		<div class="row">
		    <div class="col-9">
			<h3 class="card-title"> Create New Club </h3>
		    </div>
		    <div class="col-3">
			<a class="btn btn-success" href="{{ route('clubs.index') }}"> View All Clubs </a>
		    </div>
		</div>
	    </div>
	    <!-- /.card-header -->
	    <div class="card-body">

		<form action="{{ route('clubs.store') }}" method="POST">
		    @csrf
		    
		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Club Name</label>
			<div class="col-sm-9">
			    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
			</div>
		    </div>

		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Website</label>
			<div class="col-sm-9">
			    <input type="text" name="website" class="form-control" placeholder="http://www.example.com" value="{{ old('website') }}">
			</div>
		    </div>

		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Subdomain</label>
			<div class="col-sm-9">
			    <input type="text" name="subdomain" class="form-control" placeholder="example" value="{{ old('subdomain') }}">
			</div>
		    </div>

		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Contact First Name</label>
			<div class="col-sm-9">
			    <input type="text" name="firstName" class="form-control" value="{{ old('firstName') }}">
			</div>
		    </div>

		    <div class="form-group row mb-2">
			<label class="col-sm-3 col-form-label">Contact Last Name</label>
			<div class="col-sm-9">
			    <input type="text" name="lastName" class="form-control" value="{{ old('lastName') }}">
			</div>
		    </div>

		    <div class="form-group mt-5">
			<label for="inputEmail">Email</label>
			<input type="email" name="email" class="form-control" id="inputEmail" value="{{ old('email') }}">
		    </div>

		    <div class="form-row mt-5">
			<div class="form-group col-md-6">
			    <label for="inputPassword">Password</label>
			    <input type="password" name="password" class="form-control" id="inputPassword"
				   value="{{ old('password') }}">
			</div>
			<div class="form-group col-md-6">
			    <label for="inputPasswordConfirmation">Confirm Password</label>
			    <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation"
				   value="{{ old('password_confirmation') }}">
			</div>
		    </div>
		    
		    <div class="form-group">
			<label for="inputAddress">Address</label>
			<input type="text" name="address1" class="form-control" id="inputAddress" value="{{ old('address1') }}">
		    </div>
		    <div class="form-group">
			<label for="inputAddress2">Address 2</label>
			<input type="text" name="address2" class="form-control" id="inputAddress2" value="{{ old('address2') }}">
		    </div>
		    <div class="form-row">
			<div class="form-group col-md-4">
			    <label for="inputCity">City</label>
			    <input type="text" name="city" class="form-control"  id="inputCity" value="{{ old('city') }}">
			</div>
			<div class="form-group col-md-3">
			    <label for="inputState">State</label>
			    <select id="inputState" name="state" class="form-control">

				@if (old('state') != "")
				    <option value="{{ old('state') }}" selected> {{ Str::after(old('state'), '|') }} </option>
				@else
				    <option value=""></option>
				@endif

				@foreach ($states as $state)
				    <option value="{{$state->id}}|{{$state->name}}">{{ $state->name }}</option>
				@endforeach

			    </select>
			</div>
			
			<div class="form-group col-md-3">
			    <label for="inputCountry">Country</label>
			    <select id="inputCountry" name="country" class="form-control">

				@if (old('country') != "")
				    <option value="{{ old('country') }}" selected> {{ Str::after(old('country'), '|') }} </option>				    
				@else
				    <option value=""></option>
				@endif
				
				@foreach ($countries as $country)
				    <option value="{{$country->id}}|{{$country->name}}">{{ $country->name }}</option>				    
				@endforeach
			    </select>
			</div>
			
			<div class="form-group col-md-2">
			    <label for="inputZip">Zip</label>
			    <input type="text" name="postalCode" class="form-control" id="inputZip" value="{{ old('postalCode') }}">
			</div>
		    </div>

		    
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
			<button type="submit" class="btn btn-primary">Create New Club</button>
		    </div>
		    
		    
		    
		</form>
	    </div>
	</div>
    </div>

@endsection
