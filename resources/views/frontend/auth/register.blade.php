@extends('layouts.home')
@section('title', 'Register Konto')

@section('content')

<form class="form-signin">

	<h1 class="h3 mb-3 font-weight-normal">Register Konto</h1>

	<label for="firstname" class="sr-only">Fornavn</label>
	<div class="input-group mb-1">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-font"></i></span>
		</div>
		<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Fornavn" value="{{ old('firstname') }}" required autofocus>
	</div>

	<label for="lastname" class="sr-only">Etternavn</label>
	<div class="input-group mb-1">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-bold"></i></span>
		</div>
		<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Etternavn" value="{{ old('lastname') }}" required>
	</div>

	<label for="username" class="sr-only">Username</label>
	<div class="input-group mb-1">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-user"></i></span>
		</div>
		<input type="text" class="form-control" name="username" id="username" placeholder="Brukernavn" value="{{ old('username') }}" required>
	</div>

	<label for="email" class="sr-only">E-postadresse</label>
	<div class="input-group mb-1">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="far fa-envelope"></i></span>
		</div>
		<input type="email" class="form-control" name="email" id="email" placeholder="E-postadresse" value="{{ old('email') }}" required>
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
	</div>

	<div class="checkbox mt-3 mb-3">
		<label>
			<input type="checkbox" name="tospp" id="tospp"> Jeg har lest, akseptert og godkjent <strong>Terms of Service</strong> og <strong>Privacy Policy</strong>.
		</label>
	</div>

	<button class="btn btn-secondary btn-block" type="submit"><i class="fas fa-pencil-alt"></i> Registrer</button>

	<p class="mt-5 text-muted">
		<small>
			<a href="{{ route('account-login') }}"><i class="fa fa-lock"></i> Tilbake til innlogging</a>
		</small>
	</p>

</form>

@endsection
