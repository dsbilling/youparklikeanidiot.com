@extends('layouts.home')
@section('title', 'Innlogging')

@section('content')

<form class="form-signin">

	<h1 class="h3 mb-3 font-weight-normal">Innlogging</h1>

	<label for="email" class="sr-only">Brukernavn eller E-postadresse</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text" style="border-top-left-radius:0.25rem;border-bottom-left-radius:0;"><i class="fas fa-user"></i></span>
		</div>
		<input type="text" class="form-control" style="border-bottom-right-radius:0;" name="email" id="email" placeholder="Brukernavn eller E-postadresse" required autofocus>
	</div>

	<label for="password" class="sr-only">Passord</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text" style="border-top-left-radius:0;border-bottom-left-radius:0.25rem;"><i class="fas fa-key"></i></span>
		</div>
		<input type="text" class="form-control" style="border-top-right-radius:0;" name="password" id="password" placeholder="Passord" required>
	</div>

	<div class="checkbox mt-3 mb-3">
		<label>
			<input type="checkbox" value="remember-me"> Husk meg
		</label>
	</div>

	<button class="btn btn-secondary btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Logg inn</button>

	<p class="mt-5 mb-3 text-muted">
		<small>
			<a href="{{ route('account-credentials-forgot') }}" class="link">Glemt brukernavn/passord?</a>
			&middot;
			<a href="{{ route('account-register') }}" class="link">Trenger du en konto?</a>
			<br/>
			<a href="{{ route('account-resendverification') }}" class="link">Fikk du ikke aktiverings-e-posten?</a>
		</small>
	</p>

</form>

@endsection
