@extends('layouts.main')
@section('title', $title)

@section('content')

<h1 class="display-4 mt-4 mb-4">{{ $title }}</h1>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Hjem</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
	</ol>
</nav>

{!! $content !!}

@endsection
