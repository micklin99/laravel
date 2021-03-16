
<div class="form-group mt-5">
    <label for="inputEmail">Email</label>
    <input type="email" name="email" class="form-control" id="inputEmail"
	   value="{{ isset($user)? $user->email : old('email') }}">
</div>

<div class="form-row">
    <div class="form-group col-md-6">
	<label for="inputPassword">Password</label>
	<input type="password" name="password" class="form-control" id="inputPassword"
	       value="{{ isset($user)? $user->password : old('password') }}">
    </div>
    <div class="form-group col-md-6">
	<label for="inputPasswordConfirmation">Confirm Password</label>
	<input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation"
	       value="{{ isset($user)? $user->password : old('password_confirmation') }}">
    </div>
</div>
