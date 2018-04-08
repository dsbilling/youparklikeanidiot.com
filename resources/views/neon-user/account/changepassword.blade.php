@extends('layouts.main')
@section('title', 'Change Password')
@section('content')

<div class="container">
	<h2>Change Password</h2>
	
	<ol class="breadcrumb 2" >
		<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li><a href="{{ route('account') }}">Account</a></li>
		<li class="active"><strong>Change Password</strong></li>
	</ol>

	<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="{{ route('account-change-password-post') }}">

		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-primary">
				
					<div class="panel-body">

						<div class="row">
							<label class="col-sm-5 control-label">Current Password</label>
							<div class="col-sm-5 form-group @if ($errors->has('current_password')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
									<input class="form-control" type="password" name="current_password" id="current_password" placeholder="">
								</div>
								@if($errors->has('current_password'))
									<p class="text-danger">{{ $errors->first('current_password') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">New Password</label>
							<div class="col-sm-5 form-group @if ($errors->has('password')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
									<input class="form-control" type="password" name="password" id="password" placeholder="">
								</div>
								@if($errors->has('password'))
									<p class="text-danger">{{ $errors->first('password') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">New Password Confirmation</label>
							<div class="col-sm-5 form-group @if ($errors->has('password_confirmation')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
									<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="">
									<span class="input-group-btn"><button type="submit" class="btn btn-warning"><i class="fa fa-asterisk"></i> Change Password</button></span>
								</div>
								@if($errors->has('password_confirmation'))
									<p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
								@endif
							</div>
						</div>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</div>
					
				</div>
			
			</div>

		</div>
					
	</form>
</div>
<br /><br /><br />
@stop