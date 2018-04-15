@extends('layouts.home')
@section('title', 'Du kan nå resette passordet ditt')

@section('content')

<form class="form-signin" method="post" action="{{ route('account-password-reset-post') }}">

	<h1 class="h3 mb-3 font-weight-normal">Du kan nå resette passordet ditt</h1>

	<label for="email" class="sr-only">Code</label>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-code"></i></span>
		</div>
		<input type="text" class="form-control" name="resetpassword_code" id="resetpassword_code" readonly="readonly" value="{{ $resetpassword_code }}" autocomplete="off" disabled="disabled">
	</div>

	<label for="email" class="sr-only">Brukernavn eller E-postadresse</label>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-user"></i></span>
		</div>
		<input type="text" class="form-control" name="email" id="email" placeholder="Brukernavn eller E-postadresse" required autofocus>
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

	@foreach($errors->all() as $message)
		<p class="text-danger">{{ $message }}</p>
	@endforeach

	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	
	<button class="btn btn-success btn-block mt-3" type="submit"><i class="fas fa-check"></i> Fullfør Passord Reset</button>

	<p class="mt-5 text-muted">
		<small>
			<a href="{{ route('account-login') }}"><i class="fa fa-lock"></i> Tilbake til innlogging</a>
		</small>
	</p>

</form>

@endsection
