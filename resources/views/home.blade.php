@extends('layouts.app')

@section('content')
<div class="jumbotron">
	<h1 class="display-4">{!! __('home.title', ['url' => url('/info/idiot')]) !!}</h1>
	<div>
		{!! __('home.lead', ['url' => url('/info/idiot')]) !!}
	</div>
	<p class="mt-5">
		<a href="{{ asset('pdf/'.strtolower(app()->request->getHost()).'.pdf') }}" class="btn btn-success"><i class="fas fa-download"></i> {{ __('home.downloadpdf') }}</a>
		<small class="mx-2"><em> ~ {{ __('global.or') }} ~ </em></small>
		<a href="{{ route('parking.index') }}" class="btn btn-info"><i class="fas fa-parking"></i> {{ __('home.seeparkings') }}</a>
	</p>
</div>
@endsection
