@extends('layouts.main')
@section('title', 'Members')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Members</h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('account') }}">Dashboard</a></li>
				<li class="active"><strong>Members</strong></li>
			</ol>
		</div>

	</div>

	<div class="row">
		<div class="col-md-8">
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

			<div class="row">
				<div class="col-md-12">
					{!! $members->render() !!}
				</div>
			</div>
		</div>
		<div class="col-md-4">
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