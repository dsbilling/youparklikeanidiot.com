@extends('layouts.main')
@section('title') Home @stop

@section('content')

<div class="container">

	<div class="row latest-posts">
		<div class="col m8">



			@foreach($news as $article)
				<div class="row post">
					<div class="col s12">
						<div class="card">
							<div class="card-image">
								<h2 class="card-title"><a href="{{ route('news-show', $article->slug) }}">{{ $article->title }}</a></h2>
							</div>
							<div class="card-content">
								<p>
									<small>Published: {{ date(User::getUserDateFormat(), strtotime($article->published_at)) .' at '. date(User::getUserTimeFormat(), strtotime($article->published_at)) }} by <a class="author" href="{{ URL::route('user-profile', $article->author->username) }}">{{ User::getFullnameByID($article->author->id) }}</a> &middot; Updated: {{ date(User::getUserDateFormat(), strtotime($article->updated_at))  .' at '. date(User::getUserTimeFormat(), strtotime($article->updated_at)) }} by <a href="{{ URL::route('user-profile', $article->editor->username) }}">{{ User::getFullnameByID($article->editor->id) }}</a></small>
								</p>
								<hr>
								<p>{!! substr($article->content, 0, 1000) !!}@if(strlen($article->content) >= 1000)...@endif</p>
							</div>
							@if(strlen($article->content) >= 1000)
								<div class="card-action">
									<a href="{{ URL::route('news-show', $article->slug) }}" class="btn btn-primary btn-xs pull-right newsBtn"><i class="fa fa-arrow-circle-right"></i> Les mer</a>
								</div>
							@endif
						</div>
					</div>
				</div>
			@endforeach

			<br>
			<div class="row">
				<div class="col s12">
					<a href="{{ URL::route('news') }}" class="btn btn-primary btn-readmore"><span class="fa fa-long-arrow-left"></span> Les eldre nyheter</a>
				</div>
			</div>

		</div>

		<div class="col m4">
			<div class="row post">
				<div class="col s12">
					<div class="card">
						<div class="card-content">
							<h3>Info</h3>
						</div>
						<div class="card-action">
							<p><b>Hvor: </b> @if(LANMS\Info::getContent('where_url')) {!! '<a href="'.LANMS\Info::getContent('where_url').'">'.LANMS\Info::getContent('where').'</a>' !!} @else {{ LANMS\Info::getContent('where') }} @endif</p>
							<p><b>Når: </b> {{ LANMS\Info::getContent('when') }}</p>
							<p><b>Pris: </b> {{ LANMS\Info::getContent('price') }}@if(LANMS\Info::getContent('price_alt')) {!! '<small><em>('.LANMS\Info::getContent('price_alt').')</em></small>' !!}@endif</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row post">
				<div class="col s12">
					<div class="card">
						<div class="card-content">
							<h3>Sponsorer</h3>
						</div>
						@foreach(LANMS\Sponsor::thisYear()->get() as $sponsor)
							<div class="card-action">
								 @if($sponsor->url)
									<a href="{{ $sponsor->url }}"><img class="responsive-img" src="{{ asset($sponsor->image) }}" alt="{{ $sponsor->name }}" width="335px"></a>
								@else
									<img class="responsive-img" src="{{ asset($sponsor->image) }}" alt="{{ $sponsor->name }}" width="335px">
								@endif
								@if($sponsor->description)
									<p>{{ $sponsor->description }}</p>
								@endif
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>



@endsection
