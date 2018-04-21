@extends('layouts.main')
@section('title', 'Account')
@section('content')


<h1 class="display-4 mt-4 mb-4">Account</h1>

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ route('home') }}">Hjem</a></li>
		<li class="breadcrumb-item active" aria-current="page">Account</li>
	</ol>
</nav>

<div class="row">
	<div class="col-lg-4">

		<h3>Account Details</h3>
		<div class="list-group">
			<a href="{{ route('account-change-details') }}" class="list-group-item"><i class="fa fa-edit"></i> Edit Profile Details</a>
			<a href="{{ route('account-change-images') }}" class="list-group-item"><i class="far fa-images"></i> Change Profile Images</a>
			<a href="{{ route('account-addressbook') }}" class="list-group-item"><i class="fa fa-book"></i> Manage Address Book</a>
			<a href="{{ route('account-change-password') }}" class="list-group-item"><i class="fa fa-asterisk"></i> Change Password</a>
			<a href="{{ route('account-settings') }}" class="list-group-item"><i class="fa fa-cog"></i> Edit Profile Settings</a>
		</div>

	</div>
	<div class="col-lg-4">

	</div>
	<div class="col-lg-4">
		@if(Setting::get('REFERRAL_ACTIVE'))
			<h3>Referral</h3>
			<p>This is the referral link you can share to your friends, this will track back to you if they register at this website.</p>
			<input class="form-control" type="text" value="{{ Setting::get('WEB_PROTOCOL') }}://{{ Setting::get('WEB_DOMAIN') }}@if(Setting::get('WEB_PORT') <> 80){{ ':'.Setting::get('WEB_PORT') }}@endif/r/{{ Sentinel::getUser()->referral_code }}">
			<br>
			<p>You have referred <strong>{{ User::where('referral', '=', Sentinel::getUser()->referral_code)->count() }}</strong> @if(User::where('referral', '=', Sentinel::getUser()->referral_code)->count() == 1){{ 'user.' }} @else {{ 'users.' }} @endif</p>
		@endif
	</div>
</div>

@stop