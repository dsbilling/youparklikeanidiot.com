@extends('layouts.base.main')
@section('title', 'Change Account Details')
@section('content')
	<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2>Change Account Details</h2>
			<hr>
			<div class="row">
				<div class="col-lg-3">
					@include('layouts.base.account-sidebar')
				</div>
				<div class="col-lg-9">
					<form action="{{ URL::route('account-change-details-post') }}" method="post">

						<div class="form-group @if ($errors->has('email')) has-error @endif">
							<label for="email">Email</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
								<input class="form-control" type="text" name="email" value="{{ $email }}">
							</div>
							@if($errors->has('email'))
								<p class="text-danger">{{ $errors->first('email') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('firstname')) has-error @endif">
							<label for="firstname">Firstname</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-user"></span></span>
								<input class="form-control" type="text" name="firstname" value="{{ $firstname }}">
							</div>
							@if($errors->has('firstname'))
								<p class="text-danger">{{ $errors->first('firstname') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('lastname')) has-error @endif">
							<label for="lastname">Lastname</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-user"></span></span>
								<input class="form-control" type="text" name="lastname" value="{{ $lastname }}">
							</div>
							@if($errors->has('lastname'))
								<p class="text-danger">{{ $errors->first('lastname') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('gender')) has-error @endif">
							<label for="gender">Gender</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-heart-o"></span></span>
								<select class="form-control" name="gender">
									<option value="">-- Please select --</option>
									<option value="Male" {{ ($gender == 'Male') ? 'selected' : '' }}>Male</option>
									<option value="Female" {{ ($gender == 'Female') ? 'selected' : '' }}>Female</option>
								</select>
							</div>
							@if($errors->has('gender'))
								<p class="text-danger">{{ $errors->first('gender') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('location')) has-error @endif">
							<label for="location">Location <small>Visible on profile</small></label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-globe"></span></span>
								<input class="form-control" type="text" name="location" value="{{ $location }}">
							</div>
							@if($errors->has('location'))
								<p class="text-danger">{{ $errors->first('location') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('address')) has-error @endif">
							<label for="addressaddress">Address <small>NOT visible on profile</small></label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-globe"></span></span>
								<input class="form-control" type="text" name="address" value="{{ $address }}">
							</div>
							@if($errors->has('location'))
								<p class="text-danger">{{ $errors->first('location') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('occupation')) has-error @endif">
							<label for="occupation">Occupation</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-briefcase"></span></span>
								<input class="form-control" type="text" name="occupation" value="{{ $occupation }}">
							</div>
							@if($errors->has('occupation'))
								<p class="text-danger">{{ $errors->first('occupation') }}</p>
							@endif
						</div>
						<br><br>
						<div class="form-group">
							<label for="password">Please confirm your password</label>
							<div class="input-group">
								<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
								<input class="form-control" type="password" name="password">
							</div>
							<br>
							<p class="text-right"><button type="submit" class="btn btn-lg btn-labeled btn-success"><span class="btn-label"><i class="fa fa-save"></i></span>Save</button></p>
						</div>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@stop