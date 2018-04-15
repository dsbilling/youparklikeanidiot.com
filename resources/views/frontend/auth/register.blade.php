@extends('layouts.home')
@section('title', 'Register Konto')

@section('content')

<form class="form-signin" method="post" action="{{ route('account-register-post') }}">

	<h1 class="h3 mb-3 font-weight-normal">Register Konto</h1>

	<label for="firstname" class="sr-only">Fornavn</label>
	<div class="input-group mb-1">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-font"></i></span>
		</div>
		<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Fornavn" value="{{ old('firstname') }}" required autofocus>
		@if($errors->has('firstname'))
			<p class="text-danger">{{ $errors->first('firstname') }}</p>
		@endif
	</div>

	<label for="lastname" class="sr-only">Etternavn</label>
	<div class="input-group mb-1">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-bold"></i></span>
		</div>
		<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Etternavn" value="{{ old('lastname') }}" required>
		@if($errors->has('lastname'))
			<p class="text-danger">{{ $errors->first('lastname') }}</p>
		@endif
	</div>

	<label for="username" class="sr-only">Brukernavn</label>
	<div class="input-group mb-1">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-user"></i></span>
		</div>
		<input type="text" class="form-control" name="username" id="username" placeholder="Brukernavn" value="{{ old('username') }}" required>
		@if($errors->has('username'))
			<p class="text-danger">{{ $errors->first('username') }}</p>
		@endif
	</div>

	<label for="birthdate" class="sr-only">Bursdag</label>
	<div class="input-group mb-1">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
		</div>
		<input type="date" class="form-control" name="birthdate" id="birthdate" value="{{ old('birthdate') }}" required>
		@if($errors->has('birthdate'))
			<p class="text-danger">{{ $errors->first('birthdate') }}</p>
		@endif
	</div>

	<label for="email" class="sr-only">E-postadresse</label>
	<div class="input-group mb-1">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="far fa-envelope"></i></span>
		</div>
		<input type="email" class="form-control" name="email" id="email" placeholder="E-postadresse" value="{{ old('email') }}" required>
		@if($errors->has('email'))
			<p class="text-danger">{{ $errors->first('email') }}</p>
		@endif
	</div>

	<label for="password" class="sr-only">Passord</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text" style="border-top-left-radius:0.25rem;border-bottom-left-radius:0;"><i class="fas fa-key"></i></span>
		</div>
		<input type="password" class="form-control" style="border-bottom-right-radius:0;" name="password" id="password" placeholder="Passord" required>
	</div>

	<label for="password_confirmation" class="sr-only">Passord Igjen</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text" style="border-top-left-radius:0;border-bottom-left-radius:0.25rem;"><i class="fas fa-key"></i></span>
		</div>
		<input type="password" class="form-control" style="border-top-right-radius:0;" name="password_confirmation" id="password_confirmation" placeholder="Passord igjen" required>
		@if($errors->has('password'))
			<p class="text-danger">{{ $errors->first('password') }}</p>
		@endif
		@if($errors->has('password_confirmation'))
			<p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
		@endif
	</div>

	<div class="checkbox mt-3 mb-3">
		<label>
			<input type="checkbox" name="accept" id="accept"> Jeg har lest, akseptert og godkjent <strong>Terms of Service</strong> og <strong>Privacy Policy</strong>.
		</label>
		@if($errors->has('accept'))
			<p class="text-danger">{{ $errors->first('accept') }}</p>
		@endif
	</div>
	
	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	
	<button class="btn btn-secondary btn-block" type="submit"><i class="fas fa-pencil-alt"></i> Registrer</button>

	<p class="mt-5 text-muted">
		<small>
			<a href="{{ route('account-login') }}"><i class="fa fa-lock"></i> Tilbake til innlogging</a>
		</small>
	</p>

</form>

@endsection
