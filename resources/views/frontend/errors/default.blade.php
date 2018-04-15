@extends('layouts.home')
@section('title', 'Unknown Error')

@section('content')
	<h1 class="display-4">{{ $code }} Unknown Error</h1>
	<p class="lead">Unexpected code malfunction was encountered.</p>
@stop