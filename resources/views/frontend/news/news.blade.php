@extends('layouts.main')
@section('title', 'News')

@section('content')

<div class="container">

	<div class="row latest-posts">
		<div class="col s12">



			@foreach($news as $article)
				<div class="row post">
					<div class="col s12">
						<div class="card">
							<div class="card-content">
								<a href="{{ route('news-show', $article->slug) }}"><h1>{{ $article->title }}</h1></a>
								<p>{!! substr($article->content, 0, 1000) !!}@if(strlen($article->content) >= 1000)...@endif</p>
							</div>
							<div class="card-action">
								<small>Published: {{ date(User::getUserDateFormat(), strtotime($article->published_at)) .' at '. date(User::getUserTimeFormat(), strtotime($article->published_at)) }} by <a href="{{ URL::route('user-profile', $article->author->username) }}">{{ User::getFullnameByID($article->author->id) }}</a> &middot; Updated: {{ date(User::getUserDateFormat(), strtotime($article->updated_at))  .' at '. date(User::getUserTimeFormat(), strtotime($article->updated_at)) }} by <a href="{{ URL::route('user-profile', $article->editor->username) }}">{{ User::getFullnameByID($article->editor->id) }}</a></small>
							@if(strlen($article->content) >= 1000)
								<a href="{{ URL::route('news-show', $article->slug) }}" class="btn btn-primary btn-xs pull-right newsBtn"><i class="fa fa-arrow-circle-right"></i> Les mer</a>
							@endif
							</div>
						</div>
					</div>
				</div>
			@endforeach

      <div class="row">
        <div class="col s12">
          {!! $news->render() !!}
        </div>
      </div>

		</div>
	</div>

@endsection
