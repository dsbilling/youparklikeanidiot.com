@extends('layouts.main')
@section('title', 'Search Members')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Search Members: <em>{{ $query }}</em></h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('members') }}">Members</a></li>
				<li class="active"><strong>Search Members</strong></li>
			</ol>
		</div>

	</div>

	<div class="row">
		<div class="col-md-8">
			@if($members->count() == 0)
				<br>
				<p class="text-muted text-center">No results found.</p>
			@endif
			@foreach($members as $member)
				<div class="member-entry">
					<a href="{{ route('user-profile', $member->username) }}" class="member-img">
						<img src="{{ $member->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
						<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
					</a>
					<div class="member-details">
						<h4>
							<a href="{{ route('user-profile', $member->username) }}">{{ $member->firstname }}@if($member->showname) {{ $member->lastname }}@endif</a>
						</h4>
						<div class="row info-list">
							<div class="col-sm-6">
								<i class="fa fa-at"></i> {{ $member->username }}
							</div>
							@if($member->occupation)
								<div class="col-sm-6">
									<i class="fa fa-briefcase"></i> {{ $member->occupation }}
								</div>
							@endif
							@if($member->location)
								<div class="col-sm-6">
									<i class="fa fa-map-marker"></i> {{ $member->location or '<em>Unkown</em>' }}
								</div>
							@endif
							@if($member->gender)
								<div class="col-sm-6">
									<i class="fa fa-genderless"></i> {{ $member->gender }}
								</div>
							@endif
							@if($member->birthdate)
								<div class="col-sm-6">
									<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($member->birthdate), date_create('today'))->y }}
								</div>
							@endif
						</div>
					</div>
				</div>
			@endforeach

		</div>
		<div class="col-md-4">
			<h3>Search Members</h3>
			<hr>
			<form role="form" method="post" action="{{ route('members-search') }}">
				<div class="input-group">
					<input type="text" name="search" class="form-control" placeholder="Username or Name">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
					</span>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			</form>
			<br>

			<h3>Newest Members</h3>
			<hr>
			@foreach($newestmembers as $member)
				<div class="member-entry">
					<a href="{{ route('user-profile', $member->username) }}" class="member-img">
						<img src="{{ $member->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
						<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
					</a>
					<div class="member-details">
						<h4>
							<a href="{{ route('user-profile', $member->username) }}">{{ $member->firstname }}@if($member->showname) {{ $member->lastname }}@endif</a>
						</h4>
						<div class="row info-list">
							<div class="col-sm-6">
								<i class="fa fa-at"></i> {{ $member->username }}
							</div>
							@if($member->occupation)
								<div class="col-sm-6">
									<i class="fa fa-briefcase"></i> {{ $member->occupation }}
								</div>
							@endif
							@if($member->location)
								<div class="col-sm-6">
									<i class="fa fa-map-marker"></i> {{ $member->location }}
								</div>
							@endif
							@if($member->gender)
								<div class="col-sm-6">
									<i class="fa fa-genderless"></i> {{ $member->gender }}
								</div>
							@endif
							@if($member->birthdate)
								<div class="col-sm-6">
									<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($member->birthdate), date_create('today'))->y }}
								</div>
							@endif
						</div>
					</div>
				</div>
			@endforeach

			<h3>Last Online Members</h3>
			<hr>
			@foreach($onlinemembers as $member)
				<div class="member-entry">
					<a href="{{ route('user-profile', $member->username) }}" class="member-img">
						<img src="{{ $member->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
						<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
					</a>
					<div class="member-details">
						<h4>
							<a href="{{ route('user-profile', $member->username) }}">{{ $member->firstname }}@if($member->showname) {{ $member->lastname }}@endif</a>
						</h4>
						<div class="row info-list">
							<div class="col-sm-6">
								<i class="fa fa-at"></i> {{ $member->username }}
							</div>
							@if($member->occupation)
								<div class="col-sm-6">
									<i class="fa fa-briefcase"></i> {{ $member->occupation }}
								</div>
							@endif
							@if($member->location)
								<div class="col-sm-6">
									<i class="fa fa-map-marker"></i> {{ $member->location }}
								</div>
							@endif
							@if($member->gender)
								<div class="col-sm-6">
									<i class="fa fa-genderless"></i> {{ $member->gender }}
								</div>
							@endif
							@if($member->birthdate)
								<div class="col-sm-6">
									<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($member->birthdate), date_create('today'))->y }}
								</div>
							@endif
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>

</div>

@stop