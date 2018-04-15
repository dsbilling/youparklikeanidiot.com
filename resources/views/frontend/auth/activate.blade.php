@extends('layouts.home')
@section('title', 'Aktiver konto')

@section('content')

<form class="form-signin" method="post" action="{{ route('account-activate-post') }}">

	<h1 class="h3 mb-3 font-weight-normal">Aktiver konto</h1>

	<label for="email" class="sr-only">Code</label>
	<div class="input-group mb-2">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-code"></i></span>
		</div>
		<input type="text" class="form-control" name="activation_code" id="activation_code" readonly="readonly" value="{{ $activation_code }}" autocomplete="off" disabled="disabled">
	</div>

	<label for="email" class="sr-only">Brukernavn eller E-postadresse</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-user"></i></span>
		</div>
		<input type="text" class="form-control" name="email" id="email" placeholder="Brukernavn eller E-postadresse" required autofocus>
	</div>

	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	
	<button class="btn btn-success btn-block mt-3" type="submit"><i class="fas fa-check"></i> Fullfør aktiveringen</button>

	<p class="mt-5 text-muted">
		<small>
			<a href="{{ route('account-login') }}"><i class="fa fa-lock"></i> Tilbake til innlogging</a>
		</small>
	</p>

</form>

@endsection
