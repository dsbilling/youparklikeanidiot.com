@extends('layouts.home')
@section('title', 'Glemt brukernavn/passord')

@section('content')

<form class="form-signin" method="post" action="{{ route('account-credentials-forgot-post') }}">

	<h1 class="h3 mb-3 font-weight-normal">Glemt brukernavn<br>eller passord?</h1>

	<label for="login" class="sr-only">Brukernavn eller E-postadresse</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-user"></i></span>
		</div>
		<input type="text" class="form-control" name="login" id="login" placeholder="Brukernavn eller E-postadresse" required autofocus>
	</div>

	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

	@foreach($errors->all() as $message)
		<p class="text-danger">{{ $message }}</p>
	@endforeach

	<button class="btn btn-secondary btn-block mt-3" type="submit"><i class="fas fa-paper-plane"></i> Send e-post</button>

	<p class="mt-5 text-muted">
		<small>
			<a href="{{ route('account-login') }}"><i class="fa fa-lock"></i> Tilbake til innlogging</a>
		</small>
	</p>

</form>

@endsection
