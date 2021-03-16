
<div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" name="address1" class="form-control" id="inputAddress" 
	   value="{{ isset($address)? $address->address1 : old('address1') }}">
</div>
<div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" name="address2" class="form-control" id="inputAddress2"
	   value="{{ isset($address)? $address->address2 : old('address2') }}">
</div>
<div class="form-row">
    <div class="form-group col-md-4">
	<label for="inputCity">City</label>
	<input type="text" name="city" class="form-control"  id="inputCity"
	       value="{{ isset($address)? $address->city : old('city') }}">
    </div>
    <div class="form-group col-md-3">
	<label for="inputState">State</label>
	<select id="inputState" name="state" class="form-control">
	    @if ( isset($address) )
		<option selected> {{ $address->state->name }} </option>
	    @else
		@if (old('state') != "")
		    <option value="{{ old('state') }}" selected> {{ Str::after(old('state'), '|') }} </option>
		@else
		    <option value=""></option>
		@endif
	    @endif
	    
	    @foreach ($states as $state)
		<option value="{{$state->id}}|{{$state->name}}">{{ $state->name }}</option>
	    @endforeach
	</select>
    </div>

    <div class="form-group col-md-3">
	<label for="inputCountry">Country</label>
	<select id="inputCountry" name="country" class="form-control">
	    @if (isset($address))
		<option selected> {{ $address->country->name }} </option>
	    @else
		@if (old('country') != "")
		    <option value="{{ old('country') }}" selected> {{ Str::after(old('country'), '|') }} </option>
		@else
		    <option value=""></option>
		@endif
	    @endif

	    @foreach ($countries as $country)
		<option value="{{$country->id}}|{{$country->name}}">{{ $country->name }}</option>				    
	    @endforeach
	</select>
    </div>

    <div class="form-group col-md-2">
	<label for="inputZip">Zip</label>
	<input type="text" name="postalCode" class="form-control" id="inputZip"
	       value="{{ isset($address)? $address->postalCode : old('postalCode') }}">
    </div>
    
</div>

