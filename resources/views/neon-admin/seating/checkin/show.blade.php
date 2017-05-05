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
			<li><a href="{{ route('admin-seating') }}">Seating</a></li>
			<li class="active"><strong>Check-in</strong></li>
		</ol>

		<br />

		<div class="row">
		
			<div class="col-md-12">

				<form action="{{ route('admin-seating-checkin-store', $ticket->id) }}" method="post">

					<div class="row">
						<div class="col-sm-2 post-save-changes">
							<button type="submit" class="btn btn-green btn-lg btn-block btn-icon" id="checkin" @if(is_null($ticket->reservation->payment)) disabled="" @endif>
								Check-in
								<i class="fa fa-check"></i>
							</button>
						</div>
						
						<div class="col-sm-6 @if($errors->has('band_number')) has-error @endif">
							<input type="text" class="form-control input-lg" name="band_number" placeholder="Band Number" value="{{ (old('band_number')) ? old('band_number') : '' }}" autocomplete="off" />
							@if($errors->has('band_number'))
								<p class="text-danger">{{ $errors->first('band_number') }}</p>
							@endif
						</div>

						<div class="col-sm-4">
							@if(is_null($ticket->reservation->payment))
								<div class="checkbox">
									<label><input type="checkbox" id="paid"> Atendee has paid the total amount in cash.</label>
								</div>
							@else
								<div class="checkbox">
									<p>Antendee has nothing to pay.</p>
								</div>
							@endif
						</div>
					</div>

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>

			</div>

		</div>

		<br /><hr><br />

		<div class="row">

			<div class="col-md-4 text-center">
				@if(is_null($ticket->reservation->payment))
					<h2><strong><small>Paid:</small><br><span class="text-danger">No</span></strong></h2>
					<h3><small>To pay:</small><br>{{ Setting::get('SEATING_SEAT_PRICE_ALT') }} {{ Setting::get('SEATING_SEAT_PRICE_CURRENCY') }}</h3>
				@else
					<h2><strong><small>Paid:</small><br><span class="text-success">Yes</span></strong></h2>
				@endif
			</div>

			<div class="col-md-4">
				<div class="member-entry">
					<a href="{{ route('user-profile', $ticket->user->username) }}" class="member-img">
						<img src="{{ $ticket->user->profilepicture or '/images/profilepicture/0.png' }}" class="img-rounded" />
						<i class="fa fa-share" style="text-shadow:#000 0 0 10px"></i>
					</a>
					<div class="member-details">
						<h4>
							<a href="{{ route('user-profile', $ticket->user->username) }}">{{ $ticket->user->firstname }}@if($ticket->user->showname) {{ $ticket->user->lastname }}@endif</a>
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

			<div class="col-md-4 text-center">
				<h2><strong><small>Seat:</small><br>{{ $ticket->reservation->seat->name }}</strong></h2>
			</div>

		</div>

	</div>
</div>

@stop

@section('javascript')
	<script type="text/javascript">
		var checker = document.getElementById('paid');
		var btn 	= document.getElementById('checkin');
		checker.onchange = function() {
			btn.disabled = !this.checked;
		};
	</script>
@stop