@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li class="active"><strong>Dashboard</strong></li>
			</ol>

			<h1>Welcome back, {{ $firstname }}@if($showname && $lastname) {{ $lastname }}@endif!</h1>
			@if(Sentinel::getUser()->ownReservationsLastYear->count() > 0 && !Sentinel::getUser()->ownReservationsThisYear->count() > 0)
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> We can see that you attended last year. Want to join us for this year too? <a href="{{route('seating')}}">Check out the seating now</a>.
				</div>
			@endif
			@if(Sentinel::getUser()->age() < 16 && Sentinel::getUser()->ownReservationsThisYear->count() > 0)
				<div class="alert alert-info" role="alert">
					<i class="fa fa-info-circle"></i> Vi kan se at du er under 16 år og på arrangementet må ha med samtykkeskjema ferdig utfyllt ved innskjekking. Ferdig generert skjema finner du her: <a href="{{ route('seating-consentform') }}"><i class="fa fa-user-circle-o"></i> Samtykkeskjema</a>
				</div>
			@endif
			@if(!Sentinel::getUser()->birthdate)
				<div class="alert alert-warning" role="alert">
					<i class="fa fa-exclamation-triangle"></i> There is no birthdate assigned to your account, this is required from now on. Edit it here: <a href="{{ route('account-change-details') }}"> Change Account Details</a>
				</div>
			@endif
			<hr>
			<div class="row">
				<div class="col-lg-8">
					@foreach($news as $article)
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title"><a href="{{ route('news-show', $article->slug) }}">{{ $article->title }}</a></h3>
							</div>
							<div class="panel-body">
								{!! substr($article->content, 0, 1000) !!}@if(strlen($article->content) >= 1000)...@endif
							</div>
							<div class="panel-footer">
								<small>Published: {{ date(User::getUserDateFormat(), strtotime($article->published_at)) .' at '. date(User::getUserTimeFormat(), strtotime($article->published_at)) }} by <a class="author" href="{{ URL::route('user-profile', $article->author->username) }}">{{ User::getFullnameByID($article->author->id) }}</a> &middot; Updated: {{ date(User::getUserDateFormat(), strtotime($article->updated_at))  .' at '. date(User::getUserTimeFormat(), strtotime($article->updated_at)) }} by <a href="{{ URL::route('user-profile', $article->editor->username) }}">{{ User::getFullnameByID($article->editor->id) }}</a></small>
							@if(strlen($article->content) >= 1000)
								<a href="{{ URL::route('news-show', $article->slug) }}" class="btn btn-info btn-xs pull-right"><i class="fa fa-arrow-circle-right"></i> Read more</a>
							@endif
							</div>
						</div>
					@endforeach
					<a href="{{ route('news') }}" class="btn btn-info"><i class="fa fa-newspaper-o"></i> Read more news</a>
				</div>
				<div class="col-lg-4">
					<p class="text-center">Today is {{ date($userdateformat, time()) }}, and the time is {{ date($usertimeformat, time()) }}.</p>
					<hr>
					<p class="text-center">
						<a href="{{ route('account') }}"><i class="fa fa-user"></i> Your Account</a> &middot; <a href="{{ route('user-profile', \Sentinel::getUser()->username) }}"><i class="fa fa-user-circle-o"></i> Your Profile</a> &middot; <a href="{{ route('account-change-password') }}"><i class="fa fa-asterisk"></i> Change password</a>
					</p>
					<hr>
					<h5>Your reservations:</h5>
					<div class="list-group">
						@if(Sentinel::getUser()->reservationsThisYear()->get())
							@foreach(Sentinel::getUser()->reservationsThisYear()->get() as $reservation)
								<a href="{{ route('seating-show', $reservation->seat->slug) }}" class="list-group-item">{{ $reservation->seat->name }} &middot; {{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }} @if($reservation->payment) <span class="badge badge-success">Paid</span> @else <span class="badge badge-danger">Not paid</span> @endif</a>
							@endforeach
						@else
							<p><em>No reservations yet...</em></p>
						@endif
					</div>
					
				</div>
			</div>

		</div>
	</div>
</div>
@stop