@extends('layouts.home')
@section('title', 'Fikk du ikke aktiverings-e-posten?')

@section('content')

<form class="form-signin" method="post" action="{{ route('account-resendverification-post') }}">

	<h1 class="h3 mb-3 font-weight-normal">Fikk du ikke<br>aktiverings-e-posten?</h1>

	<label for="email" class="sr-only">E-postadresse</label>
	<div class="input-group">
		<div class="input-group-prepend">
			<span class="input-group-text"><i class="fas fa-user"></i></span>
		</div>
		<input type="text" class="form-control" name="email" id="email" placeholder="E-postadresse" required autofocus>
	</div>

	@foreach($errors->all() as $message)
		<p class="text-danger">{{ $message }}</p>
	@endforeach

	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	
	<button class="btn btn-secondary btn-block mt-3" type="submit"><i class="fas fa-paper-plane"></i> Send e-post</button>

	<p class="mt-5 text-muted">
		<small>
			<a href="{{ route('account-login') }}"><i class="fa fa-lock"></i> Tilbake til innlogging</a>
		</small>
	</p>

</form>

@endsection
