@extends('layouts.main')
@section('title', 'Account')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Account</h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li class="active"><strong>Account</strong></li>
			</ol>
			<div class="row">
				<div class="col-lg-4">

					<h3>Account Details</h3>
					<div class="list-group">
						<a href="{{ route('account-change-details') }}" class="list-group-item"><i class="fa fa-edit"></i> Edit Profile Details</a>
						<a href="{{ route('account-change-images') }}" class="list-group-item"><i class="fa fa-picture-o"></i> Change Profile Images</a>
						<a href="{{ route('account-addressbook') }}" class="list-group-item"><i class="fa fa-book"></i> Manage Address Book</a>
						<a href="{{ route('account-change-password') }}" class="list-group-item"><i class="fa fa-asterisk"></i> Change Password</a>
						<a href="{{ route('account-settings') }}" class="list-group-item"><i class="fa fa-cog"></i> Edit Profile Settings</a>
					</div>

				</div>
				<div class="col-lg-4">

					<h3>Reservations</h3>
					<div class="list-group">
						<a href="{{ route('account-reservation') }}" class="list-group-item"><i class="fa fa-street-view"></i> Reservations <span class="badge badge-primary">{{ \Sentinel::getUser()->reservations->count() }}</span></a>
					</div>

					<h3>Billing</h3>
					<div class="list-group">
						<a href="{{ route('account-billing-payments') }}" class="list-group-item"><i class="fa fa-money"></i> Payments <span class="badge badge-primary">{{ \Sentinel::getUser()->seatpayments->count() }}</span></a>
						<a href="{{ route('account-billing-charges') }}" class="list-group-item"><i class="fa fa-credit-card"></i> Charges</a>
					</div>

				</div>
				<div class="col-lg-4">
					@if(Setting::get('REFERRAL_ACTIVE'))
						<h3>Referral</h3>
						<p>This is the referral link you can share to your friends, this will track back to you if they register at this website.</p>
						<input class="form-control" type="text" value="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/r/{{ Sentinel::getUser()->referral_code }}">
						<br>
						<p>You have referred <strong>{{ User::where('referral', '=', Sentinel::getUser()->referral_code)->count() }}</strong> @if(User::where('referral', '=', Sentinel::getUser()->referral_code)->count() == 1){{ 'user' }} @else {{ 'users' }} @endif</p>
					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@stop