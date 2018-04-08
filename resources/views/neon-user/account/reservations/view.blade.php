@extends('layouts.main')
@section('title', 'Reservation #'.$reservation->id)
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Reservation <small>#{{ $reservation->id }}</small></h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('account') }}">Account</a></li>
				<li><a href="{{ route('account-reservation') }}">Reservations</a></li>
				<li class="active"><strong>Reservation #{{ $reservation->id }}</strong></li>
			</ol>

			<div class="row">
				<div class="col-md-4">
					<h3>Reserved by</h3>
					<div class="member-entry">
						<a href="{{ route('user-profile', $reservation->reservedby->username) }}" class="member-img">
							<img src="{{ $reservation->reservedby->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
							<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
						</a>
						<div class="member-details">
							<h4>
								<a href="{{ route('user-profile', $reservation->reservedby->username) }}">{{ User::getFullnameAndNicknameByID($reservation->reservedby->id) }}</a>
							</h4>
							<div class="row info-list">
								@if($reservation->reservedby->occupation)
									<div class="col-sm-6">
										<i class="fa fa-briefcase"></i> {{ $reservation->reservedby->occupation }}
									</div>
								@endif
								@if($reservation->reservedby->location)
									<div class="col-sm-6">
										<i class="fa fa-map-marker"></i> {{ $reservation->reservedby->location }}
									</div>
								@endif
								<div class="clear"></div>
								@if($reservation->reservedby->gender)
									<div class="col-sm-6">
										<i class="fa fa-genderless"></i> {{ $reservation->reservedby->gender }}
									</div>
								@endif
								@if($reservation->reservedby->birthdate)
									<div class="col-sm-6">
										<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($reservation->reservedby->birthdate), date_create('today'))->y }}
									</div>
								@endif
							</div>
						</div>
					</div>

				</div>
				<div class="col-md-4">
					<h3>Reserved for</h3>
					<div class="member-entry">
						<a href="{{ route('user-profile', $reservation->reservedfor->username) }}" class="member-img">
							<img src="{{ $reservation->reservedfor->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
							<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
						</a>
						<div class="member-details">
							<h4>
								<a href="{{ route('user-profile', $reservation->reservedfor->username) }}">{{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</a>
							</h4>
							<div class="row info-list">
								@if($reservation->reservedfor->occupation)
									<div class="col-sm-6">
										<i class="fa fa-briefcase"></i> {{ $reservation->reservedfor->occupation }}
									</div>
								@endif
								@if($reservation->reservedfor->location)
									<div class="col-sm-6">
										<i class="fa fa-map-marker"></i> {{ $reservation->reservedfor->location }}
									</div>
								@endif
								<div class="clear"></div>
								@if($reservation->reservedfor->gender)
									<div class="col-sm-6">
										<i class="fa fa-genderless"></i> {{ $reservation->reservedfor->gender }}
									</div>
								@endif
								@if($reservation->reservedfor->birthdate)
									<div class="col-sm-6">
										<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($reservation->reservedfor->birthdate), date_create('today'))->y }}
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<h3>Info</h3>
					
				</div>
			</div>
		</div>
	</div>
</div>
@stop