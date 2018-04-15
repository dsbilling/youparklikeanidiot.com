@extends('layouts.main')
@section('title', 'News')

@section('content')
	<h1 class="display-4 mt-4 mb-4">Nyheter</h1>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">Hjem</a></li>
			<li class="breadcrumb-item active" aria-current="page">Nyheter</li>
		</ol>
	</nav>

	@foreach($news as $article)
		<div class="card mb-4 mt-4">
			<div class="card-body">
				<h3 class="card-title"><a href="{{ route('news-show', $article->slug) }}">{{ $article->title }}</a></h3>
				<p class="card-text">{!! substr($article->content, 0, 1000) !!}@if(strlen($article->content) >= 1000)...@endif</p>			
			</div>                  
			<div class="card-footer">
				<small>Publisert: {{ date(User::getUserDateFormat(), strtotime($article->published_at)) .' at '. date(User::getUserTimeFormat(), strtotime($article->published_at)) }} by <a href="{{ URL::route('user-profile', $article->author->username) }}">{{ User::getFullnameByID($article->author->id) }}</a> &middot; Oppdatert: {{ date(User::getUserDateFormat(), strtotime($article->updated_at))  .' at '. date(User::getUserTimeFormat(), strtotime($article->updated_at)) }} by <a href="{{ URL::route('user-profile', $article->editor->username) }}">{{ User::getFullnameByID($article->editor->id) }}</a></small>
				@if(strlen($article->content) >= 1000)
					<a href="{{ URL::route('news-show', $article->slug) }}" class="btn btn-sm btn-secondary float-right">Les mer <i class="fa fa-angle-right"></i></a>
				@endif
			</div>
		</div>
	@endforeach

	{!! $news->links('layouts.pagination') !!}

@endsection
