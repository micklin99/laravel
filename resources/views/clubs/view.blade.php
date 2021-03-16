@extends('fortygoals')

@section('content')

    <div class="col-12">
	<div class="card mx-3">
	    <div class="card-header">
		<div class="row">
	    	    <div class="col-9">
			<h3 class="card-title">{{ $club->name }} </h3>
		    </div>
		    <div class="col-3">
			<a class="btn btn-success" href="{{ route('clubs.index') }}"> View All Clubs</a>
		    </div>
		</div>
	    </div>
	    <!-- /.card-header -->
	    <div class="card-body">

		<form>
		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Club Name</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext" value="{{ $club->name }}">
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Website</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext" value="{{ $club->website}}">
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Subdomain</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext" value="{{ $club->subdomain}}">
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Contact Info</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext"
				   value="{{ $club->admin()->firstName}} {{ $club->admin()->lastName}} ">
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Account Status</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext"
				   value="{{ $club->admin()->accountOwner ? "Account Owner":"Not Account Owner"}}" >
			</div>
		    </div>


		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Email</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext"
				   value="{{ $club->admin()->user->email }}" >
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Address</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext"
				   value="{{ $club->admin()->contact->address->address1 }}" >
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Address (line 2)</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext"
				   value="{{ $club->admin()->contact->address->address2 }}" >
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">City</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext"
				   value="{{ $club->admin()->contact->address->city }}" >
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">State</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext"
				   value="{{ $club->admin()->contact->address->state->name }}" >
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Country</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext"
				   value="{{ $club->admin()->contact->address->country->name }}" >
			</div>
		    </div>

		    <div class="form-group row mb-0">
			<label class="col-sm-2 col-form-label">Postal Code</label>
			<div class="col-sm-10">
			    <input type="text" readonly class="form-control-plaintext"
				   value="{{ $club->admin()->contact->address->postalCode }}" >
			</div>
		    </div>

		    
		</form>
		
	    </div> <!-- class-body -->
	</div>
    </div>

@endsection
