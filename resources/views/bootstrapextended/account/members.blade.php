@extends('layouts.base.main')
@section('title') Members @stop

@section('content')
	<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<h3>Members</h3>
			<hr>
			<div class="list-group">
				@foreach($members as $member)
					<div class="list-group-item">
						<div class="row-picture">
							<img class="circle" alt="{{ e($member->username) }}" src="@if($member->profilepicturesmall){{$member->profilepicturesmall}}@else{{{'/img/profilepicture/0_small.png'}}}@endif">
						</div>
						<div class="row-content">
							<h4 class="list-group-item-heading"><a href="{{ URL::route('user-profile', $member->username) }}">{{ e($member->username) }}</a></h4>
							<p class="list-group-item-text">
								@if($member->showname)<small>Name: {{ $member->firstname .' '. $member->lastname }}</small> |@endif @if($member->last_activity)<small>Last online: {{ e(App\User::getLastActivity($member->id)) }}</small>@endif
							</p>
						</div>
					</div>
					<div class="list-group-separator"></div>
				@endforeach
			</div>

			<div class="pull-right">
				{{ $members->render() }}
			</div>
		</div>
		<div class="col-lg-4">
			<h3>Newest members</h3>
			<hr>
			@if($newestmembers == null)
				<p class="text-muted"><em>No users to find...</em></p>
			@else
				<div class="list-group">
					@foreach($newestmembers as $member)
						<div class="list-group-item">
							<div class="row-picture">
								<img class="circle" alt="{{ e($member->username) }}" src="@if($member->profilepicturesmall){{$member->profilepicturesmall}}@else{{{'/img/profilepicture/0_small.png'}}}@endif">
							</div>
							<div class="row-content">
								<h4 class="list-group-item-heading"><a href="{{ URL::route('user-profile', $member->username) }}">{{ e($member->username) }}</a></h4>
								<p class="list-group-item-text">
									@if($member->showname)<small>Name: {{ $member->firstname .' '. $member->lastname }}</small>@endif
									<br><small>Registered on: {{ date(App\User::getUserDateFormat(), strtotime($member->created_at)) }} at {{ date(App\User::getUserTimeFormat(), strtotime($member->created_at)) }}</small>
								</p>
							</div>
						</div>
						<div class="list-group-separator"></div>
					@endforeach
				</div>
			@endif

			<h3>Last online members</h3>
			<hr>
			@if($onlinemembers == null)
				<p class="text-muted"><em>No users to find...</em></p>
			@else
				<div class="list-group">
					@foreach($onlinemembers as $member)
						<div class="list-group-item">
							<div class="row-picture">
								<img class="circle" alt="{{ e($member->username) }}" src="@if($member->profilepicturesmall){{$member->profilepicturesmall}}@else{{{'/img/profilepicture/0_small.png'}}}@endif">
							</div>
							<div class="row-content">
								<h4 class="list-group-item-heading"><a href="{{ URL::route('user-profile', $member->username) }}">{{ e($member->username) }}</a></h4>
								<p class="list-group-item-text">
									@if($member->last_activity)<small>Last online: {{ e(App\User::getLastActivity($member->id)) }}</small>@endif
								</p>
							</div>
						</div>
						<div class="list-group-separator"></div>
					@endforeach
				</div>
			@endif
		</div>
	</div>
</div>
@stop