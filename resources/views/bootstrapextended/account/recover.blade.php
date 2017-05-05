@extends('layouts.base.main')
@section('title', 'Recover My Account')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">

			<h2>Recover My Account</h2>
			<hr>
			<form action="{{ URL::route('account-recover-post', $passwordtoken) }}" method="post">

				<div class="form-group @if ($errors->has('email')) has-error @endif">
					<label for="email">Verify your email</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="fa fa-envelope-o"></span></span>
						<input class="form-control" type="text" name="email" id="email" placeholder="" autocomplete="off">
					</div>
					@if($errors->has('email'))
						<p class="text-danger">{{ $errors->first('email') }}</p>
					@endif
				</div>

				<div class="form-group @if ($errors->has('password')) has-error @endif">
					<label for="password">New Password</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
						<input class="form-control" type="password" name="password" id="password" placeholder="" autocomplete="off">
					</div>
					@if($errors->has('password'))
						<p class="text-danger">{{ $errors->first('password') }}</p>
					@endif
				</div>

				<div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
					<label for="password_confirmation">New Password Again</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
						<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="" autocomplete="off">
					</div>
					@if($errors->has('password_confirmation'))
						<p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
					@endif
				</div>

				<br><hr>
				<p class="text-right"><button type="submit" class="btn btn-lg btn-labeled btn-warning"><span class="btn-label"><i class="fa fa-retweet"></i></span>Recover</button></p>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
		</div>
	</div>
</div>
@stop