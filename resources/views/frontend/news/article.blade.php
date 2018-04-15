@extends('layouts.main')
@section('title', $article->title.' - Nyheter')

@section('content')

<h1 class="display-4 mt-4 mb-4">{{ $article->title }}</h1>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Hjem</a></li>
		<li class="breadcrumb-item"><a href="{{ route('news') }}">Nyheter</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
	</ol>
</nav>

<p class="lead">Published: {{ date(User::getUserDateFormat(), strtotime($article->published_at)) .' at '. date(User::getUserTimeFormat(), strtotime($article->published_at)) }} by <a href="{{ URL::route('user-profile', $article->author->username) }}">{{ User::getFullnameByID($article->author->id) }}</a> &middot; Updated: {{ date(User::getUserDateFormat(), strtotime($article->updated_at))  .' at '. date(User::getUserTimeFormat(), strtotime($article->updated_at)) }} by <a href="{{ URL::route('user-profile', $article->editor->username) }}">{{ User::getFullnameByID($article->editor->id) }}</a></p>

{!! $article->content !!}

@endsection
