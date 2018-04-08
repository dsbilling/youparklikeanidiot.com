@extends('layouts.main')
@section('title', 'Check-in - Admin')
@section('css')
	<style>
		.ms-container .ms-list {
			width: 135px;
			height: 205px;
		}
		
		.post-save-changes {
			float: right;
		}
		
		@media screen and (max-width: 789px)
		{
			.post-save-changes {
				float: none;
				margin-bottom: 20px;
			}
		}
	</style>
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Check-in</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>Seating</li>
			<li class="active"><strong>Check-in</strong></li>
		</ol>

		<br />
		
		<form action="{{ route('admin-seating-checkin-check') }}" method="post">

			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Find Ticket
						<i class="fa fa-ticket"></i>
					</button>
				</div>
				
				<div class="col-sm-10 @if($errors->has('ticket_id')) has-error @endif">
					<input type="text" class="form-control input-lg" name="ticket_id" placeholder="Ticket ID" value="{{ (old('ticket_id')) ? old('ticket_id') : '' }}" autocomplete="off" autofocus />
					@if($errors->has('ticket_id'))
						<p class="text-danger">{{ $errors->first('ticket_id') }}</p>
					@endif
				</div>
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>

		<br><hr><br>

		<div class="row">

			<div class="col-md-6">

				<h1 class="text-center">{{ Checkin::thisYear()->count() }}<small>/{{ $reservedcount }}</small><br><small>Atendees has checked-in</small></h1>
				<hr>

				@foreach($checkedin as $checkin)
					<div class="col-md-6">
						<div class="member-entry">
							<a href="{{ route('user-profile', $checkin->ticket->user->username) }}" class="member-img">
								<img src="{{ $checkin->ticket->user->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
								<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
							</a>
							<div class="member-details">
								<h4>
									<a href="{{ route('user-profile', $checkin->ticket->user->username) }}">{{ $checkin->ticket->user->firstname }}@if($checkin->ticket->user->showname) {{ $checkin->ticket->user->lastname }}@endif</a>
								</h4>
								<div class="row info-list">
									@if($checkin->ticket->user->occupation)
										<div class="col-sm-6">
											<i class="fa fa-briefcase"></i> {{ $checkin->ticket->user->occupation }}
										</div>
									@endif
									@if($checkin->ticket->user->location)
										<div class="col-sm-6">
											<i class="fa fa-map-marker"></i> {{ $checkin->ticket->user->location or '<em>Unkown</em>' }}
										</div>
									@endif
									<div class="clear"></div>
									@if($checkin->ticket->user->gender)
										<div class="col-sm-6">
											<i class="fa fa-genderless"></i> {{ $checkin->ticket->user->gender }}
										</div>
									@endif
									@if($checkin->ticket->user->birthdate)
										<div class="col-sm-6">
											<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($checkin->ticket->user->birthdate), date_create('today'))->y }}
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>

			<div class="col-md-6">

				<h1 class="text-center"><br><small>Seats not checked in: {{ $noncheckedin->count() }}</small></h1>
				<hr>
				@foreach($noncheckedin as $ticket)
					<div class="col-md-6">
						<div class="member-entry">
							<a href="{{ route('user-profile', $ticket->user->username) }}" class="member-img">
								<img src="{{ $ticket->user->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
								<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
							</a>
							<div class="member-details">
								<h4>
									@if($ticket->reservation){{ $ticket->reservation->seat->name }} @else {{ 'N/A' }}@endif | <a href="{{ route('user-profile', $ticket->user->username) }}">{{ $ticket->user->firstname }}@if($ticket->user->showname) {{ $ticket->user->lastname }}@endif</a>
								</h4>
								<div class="row info-list">
									@if($ticket->user->occupation)
										<div class="col-sm-6">
											<i class="fa fa-briefcase"></i> {{ $ticket->user->occupation }}
										</div>
									@endif
									@if($ticket->user->location)
										<div class="col-sm-6">
											<i class="fa fa-map-marker"></i> {{ $ticket->user->location or '<em>Unkown</em>' }}
										</div>
									@endif
									<div class="clear"></div>
									@if($ticket->user->gender)
										<div class="col-sm-6">
											<i class="fa fa-genderless"></i> {{ $ticket->user->gender }}
										</div>
									@endif
									@if($ticket->user->birthdate)
										<div class="col-sm-6">
											<i class="fa fa-birthday-cake"></i> {{ date_diff(date_create($ticket->user->birthdate), date_create('today'))->y }}
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach

			</div>

		</div>

	</div>
</div>

@stop