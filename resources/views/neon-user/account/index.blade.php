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
					<div class="row">
						<div class="col-lg-3">
							<img src="{{ $profilepicturesmall or '/images/profilepicture/0_small.png' }}" class="img-thumbnail">
						</div>
						<div class="col-lg-9">
							<h3>
								<a href="{{ route('user-profile', $username) }}">{{ $firstname }}@if($showname && $lastname) {{ $lastname }}@endif</a>
								@if($showonline)
									<a href="#" class="user-status is-{{ $onlinestatus }} tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="{{ ucfirst($onlinestatus) }}"></a>
									<!-- User statuses available classes "is-online", "is-offline", "is-idle", "is-busy" -->
								@endif
							</h3>
							<p>@if($birthdate){{ date_diff(date_create($birthdate), date_create('today'))->y }}@endif @if($location) from {{ $location }}@endif</p>
						</div>
					</div>
					<hr>
					<p class="text-center">Today is {{ date($userdateformat, time()) }}, and the time is {{ date($usertimeformat, time()) }}.</p>
					<hr>
					<p><em>Want to do some changes to your profile?</em></p>
					<div class="list-group">
						<a href="{{ route('account-change-details') }}" class="list-group-item"><i class="fa fa-edit"></i> Edit Profile Details</a>
						<a href="{{ route('account-change-images') }}" class="list-group-item"><i class="fa fa-picture-o"></i> Change Profile Images</a>
						<a href="{{ route('account-addressbook') }}" class="list-group-item"><i class="fa fa-book"></i> Manage Address Book</a>
						<a href="{{ route('account-change-password') }}" class="list-group-item"><i class="fa fa-asterisk"></i> Change Password</a>
						<a href="{{ route('account-settings') }}" class="list-group-item"><i class="fa fa-cog"></i> Edit Profile Settings</a>
					</div>
					@if(Setting::get('REFERRAL_ACTIVE'))
						<hr>
						<p>
							<strong>Your referral link:</strong><br>
							<input class="form-control" type="text" name="referrallink" id="referrallink" value="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/r/{{ $referral_code }}">
						</p>
						<p>You have referred <strong>{{ User::where('referral', '=', Sentinel::getUser()->referral_code)->count() }}</strong> user(s).</p>
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@stop