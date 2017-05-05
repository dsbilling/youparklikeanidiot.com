@extends('layouts.base.main')
@section('title', 'Change Password')
@section('content')

<div class="container">
		<div class="row">
		<div class="col-lg-12">
			<h2>Change Password</h2>
			<hr>
			<div class="row">
				<div class="col-lg-3">
					@include('layouts.base.account-sidebar')
				</div>
				<div class="col-lg-9">
					<form action="{{ route('account-change-password-post') }}" method="post">

						<div class="form-group @if ($errors->has('current_password')) has-error @endif">
							<label for="current_password">Current Password</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
								<input class="form-control" type="password" name="current_password" id="current_password" placeholder="">
							</div>
							@if($errors->has('current_password'))
								<p class="text-danger">{{ $errors->first('current_password') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('password')) has-error @endif">
							<label for="password">New Password</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
								<input class="form-control" type="password" name="password" id="password" placeholder="">
							</div>
							@if($errors->has('password'))
								<p class="text-danger">{{ $errors->first('password') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
							<label for="password_confirmation">New Password Again</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
								<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="">
							</div>
							@if($errors->has('password_confirmation'))
								<p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
							@endif
						</div>
						<br><hr>
						<p class="text-right"><button type="submit" class="btn btn-lg btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-asterisk"></i></span>Change</button></p>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop