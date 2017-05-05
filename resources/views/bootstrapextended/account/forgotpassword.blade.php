@extends('layouts.base.main')
@section('title', 'Forgot Password')
@section('content')

<div class="container">
		<div class="row">
		<div class="col-lg-12">
			<h2>Forgot Password</h2>
			<hr>
			<form action="{{ URL::route('account-forgotpassword-post') }}" method="post">

				<div class="form-group @if ($errors->has('email')) has-error @endif">
					<label for="email">Your Email</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="fa fa-envelope-o"></span></span>
						<input class="form-control" type="text" name="email" id="email" placeholder="">
					</div>
					@if($errors->has('email'))
						<p class="text-danger">{{ $errors->first('email') }}</p>
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