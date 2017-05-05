@extends('layouts.main')
@section('title', 'Change Account Details')
@section('content')

<div class="container">
	<h2>Change Account Details</h2>
	
	<ol class="breadcrumb 2" >
		<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="{{ route('account') }}">Dashboard</a></li>
		<li class="active"><strong>Change Account Details</strong></li>
	</ol>

	<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="{{ route('account-change-details-post') }}">

		<div class="row">
			<div class="col-md-6">
				
				<div class="panel panel-primary">
				
					<div class="panel-heading">
						<div class="panel-title">
							Personal Details
						</div>
					</div>
					
					<div class="panel-body">

						<div class="row">
							<label class="col-sm-5 control-label">Email</label>
							<div class="col-sm-5 form-group @if ($errors->has('email')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-envelope"></span></span>
									<input class="form-control" type="text" name="email" placeholder="john@doe.com" value="{{ $email }}" disabled readonly>
								</div>
								<p class="text-muted"><em>It is not possible to change email at this time.</em></p>
								@if($errors->has('email'))
									<p class="text-danger">{{ $errors->first('email') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Firstname</label>
							<div class="col-sm-5 form-group @if ($errors->has('firstname')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-user"></span></span>
									<input class="form-control" type="text" name="firstname" placeholder="John" value="{{ $firstname }}">
								</div>
								@if($errors->has('firstname'))
									<p class="text-danger">{{ $errors->first('firstname') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Lastname</label>
							<div class="col-sm-5 form-group @if ($errors->has('lastname')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-user-secret"></span></span>
									<input class="form-control" type="text" name="lastname" placeholder="Doe" value="{{ $lastname }}">
								</div>
								@if($errors->has('lastname'))
									<p class="text-danger">{{ $errors->first('lastname') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Gender</label>
							<div class="col-sm-5 form-group @if ($errors->has('gender')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-genderless"></span></span>
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
						</div>
					
					</div>
					
				</div>
			
			</div>
			
			
			<div class="col-md-6">
				
				<div class="panel panel-primary">
				
					<div class="panel-heading">
						<div class="panel-title">
							Other Information
						</div>
					</div>
					
					<div class="panel-body">

						<div class="row">
							<label class="col-sm-5 control-label">Occupation</label>
							<div class="col-sm-5 form-group @if ($errors->has('occupation')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-briefcase"></span></span>
									<input class="form-control" type="text" name="occupation" placeholder="IT Technician" value="{{ $occupation }}">
								</div>
								@if($errors->has('occupation'))
									<p class="text-danger">{{ $errors->first('occupation') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Location<br><small>Visible on profile</small></label>
							<div class="col-sm-5 form-group @if ($errors->has('location')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-globe"></span></span>
									<input class="form-control" type="text" name="location" placeholder="Oslo, Norway" value="{{ $location }}">
								</div>
								@if($errors->has('location'))
									<p class="text-danger">{{ $errors->first('location') }}</p>
								@endif
							</div>
						</div>
						
					</div>
				
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-primary">
				
					<div class="panel-heading">
						<div class="panel-title">
							Confirm your password
						</div>
					</div>
					
					<div class="panel-body">

						<div class="row">
							<label class="col-sm-5 control-label">Password</label>
							<div class="col-sm-5 form-group @if ($errors->has('password')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
									<input class="form-control" type="password" name="password">
								</div>
								@if($errors->has('password'))
									<p class="text-danger">{{ $errors->first('password') }}</p>
								@endif
							</div>
						</div>
						
					</div>
				
				</div>
			</div>
		</div>
											
		<div class="form-group default-padding">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
		</div>
					
	</form>
</div>
<br /><br /><br />
@stop