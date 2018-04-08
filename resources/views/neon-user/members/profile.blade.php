@extends('layouts.main')
@section('title', $username . '\'s Profile')
@section('css')
	@if($profilecover)
		<style type="text/css">
			.profile-info-tabs {
				background:url("{{ $profilecover }}") no-repeat center center !important;
			}	
		</style>
	@endif
	<link rel="stylesheet" href="{{ Theme::url('css/neon-timeline.css') }}">
@endsection
   
@section('content')

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-2">
			<a class="profile-picture" @if(\Sentinel::getUser()->id == $id) href="{{ route('account-change-images') }}" @endif>
				<img class="img-circle img-responsive" src="{{ $profilepicture or '/images/profilepicture/0.png' }}"></img>
			</a>
		</div>
		
		<div class="col-sm-7">
			
			<ul class="profile-info-sections">
				<li>
					<div class="profile-name">
						<strong>
							{{ $firstname }}@if($showname) {{ $lastname }}@endif
							@if($showonline)
								<a href="#" class="user-status is-{{ $onlinestatus }} tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="{{ ucfirst($onlinestatus) }}"></a>
								<!-- User statuses available classes "is-online", "is-offline", "is-idle", "is-busy" -->
							@endif
						</strong>
						<span>
							@if(Sentinel::findById($id)->inRole('admin') || Sentinel::findById($id)->inRole('superadmin') || Sentinel::findById($id)->inRole('moderator'))
								Staff
							@else
								Member
							@endif
						</span>
					</div>
				</li>
				
				
				<li>
					<div class="profile-stat">
						<h3>{{ Sentinel::findById($id)->reservations->count() }}</h3>
						<span>seats reserved</span>
					</div>
				</li>
				@if(Sentinel::findById($id)->ownReservationsThisYear->count()>0)
					<li>
						<div class="profile-stat">
							<h3>{{\Setting::get('SEATING_YEAR')}}</h3>
							<span>attendance</span>
						</div>
					</li>
				@endif
			</ul>
			
		</div>
		
		<div class="col-sm-3">
			<!--
			<div class="profile-buttons">
				<a href="#" class="btn btn-default">
					<i class="fa fa-envelope-o"></i>
				</a>
			</div>
			-->
		</div>
		
	</header>
	
	<section class="profile-info-tabs blur-image">
		
		<div class="row">
			
			<div class="col-sm-offset-2 col-sm-10">
				
				<ul class="user-details">

					<li><a><i class="fa fa-at"></i> {{ $username }}</a></li>
					
					@if($location)
						<li><a><i class="fa fa-map-marker"></i> {{ $location }}</a></li>
					@endif

					@if($gender)
						<li><a><i class="fa fa-{{ User::getGenderIcon($gender) }}"></i> {{ $gender }}</a></li>
					@endif

					@if($occupation)
						<li><a><i class="fa fa-suitcase"></i> {{ $occupation }}</a></li>
					@endif

					@if($showemail)
						<li><a><i class="fa fa-envelope-o"></i> {{ $email }}</a></li>
					@endif
					
					@if($birthdate)
						<li><a><i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($birthdate), date_create('today'))->y }} years old</a></li>
					@endif
				</ul>
				
				
				<!-- tabs for the profile links -->
				<ul class="nav nav-tabs">
					<li class="active"><a>Profile</a></li>
					@if(\Sentinel::getUser()->id == $id)
						<li><a href="{{ route('account-change-details') }}"><i class="fa fa-edit"></i> Edit Profile Details</a></li>
						<li><a href="{{ route('account-change-password') }}"><i class="fa fa-asterisk"></i> Change Password</a></li>
						<li><a href="{{ route('account-settings') }}"><i class="fa fa-cog"></i> Edit Profile Settings</a></li>
					@endif
				</ul>
				
			</div>
			
		</div>
		
	</section>

</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<ul class="cbp_tmtimeline">
				<li>
					<time class="cbp_tmtime"><span class="large">Now</span></time> 
					<div class="cbp_tmicon"> <i class="fa fa-user"></i> </div>
					<div class="cbp_tmlabel empty"> <span>No Activity</span> </div>
				</li>
				@if(Sentinel::findById($id)->ownReservationsThisYear->count()>0)
					@foreach(Sentinel::findById($id)->ownReservationsThisYearDecending as $reservation)
						<li>
							<time class="cbp_tmtime"><span>{{ date('Y', strtotime($reservation->created_at)) }}</span> <span>{{ date('M', strtotime($reservation->created_at)) }}</span></time> 
							<div class="cbp_tmicon bg-info"> <i class="fa fa-street-view"></i> </div>
							<div class="cbp_tmlabel">
								<h2 style="padding-bottom:0px;">{{ $firstname }}@if($showname) {{ $lastname }}@endif <span>reserved a seat for</span> {{\Setting::get('WEB_NAME')}} {{ $reservation->year }}</h2>
							</div>
						</li>
					@endforeach
				@endif
				@if(Sentinel::findById($id)->ownReservationsLastYear->count()>0)
					@foreach(Sentinel::findById($id)->ownReservationsLastYearDecending as $reservation)
						<li>
							<time class="cbp_tmtime"><span>{{ date('Y', strtotime($reservation->created_at)) }}</span> <span>{{ date('M', strtotime($reservation->created_at)) }}</span></time> 
							<div class="cbp_tmicon bg-info"> <i class="fa fa-street-view"></i> </div>
							<div class="cbp_tmlabel">
								<h2 style="padding-bottom:0px;">{{ $firstname }}@if($showname) {{ $lastname }}@endif <span>reserved a seat for</span> {{\Setting::get('WEB_NAME')}} {{ $reservation->year }}</h2>
							</div>
						</li>
					@endforeach
				@endif
			</ul>
		</div>
	</div>
</div>

@stop