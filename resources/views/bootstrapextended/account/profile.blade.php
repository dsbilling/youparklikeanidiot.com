@extends('layouts.base.main')
@section('title') {{ $username }}'s Profile @stop
   
@section('content')

<div class="profile">
	<div class="profile-image-cover" style="background-image: url('{{ $profilecover or '../img/profilecover/0.jpg' }}');">
		<div class="visible-xs col-md-12">
			<img align="left" class="profile-image-xs thumbnail" src="{{ $profilepicture or '../img/profilepicture/0.png' }}" alt="{{ $username }}"/>
			<div class="profile-text-xs">
				<h1>{{ $username }} <small>{{ $firstname }} {{ $lastname }}</small></h1>
				<p>{{ $email }}</p>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hidden-xs">
					<img align="left" class="profile-image thumbnail" src="{{ $profilepicture or '../img/profilepicture/0.png' }}" alt="{{ $username }}"/>
					<div class="profile-text">
						<h1>{{ $username }} <small>{{ $firstname }} {{ $lastname }}</small></h1>
						<p>{{ $email }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
@stop