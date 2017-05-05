@extends('layouts.main')
@section('title', 'Edit Reservation - #'.$reservation->id.' - Admin')
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

		<h1 class="margin-bottom">Edit Reservation: <small>#{{ $reservation->id }}</small></h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-seating-reservations') }}">Reservations</a></li>
			<li class="active"><strong>Edit Reservation #{{ $reservation->id }}</strong></li>
		</ol>
					
		<br />
		
		<form action="{{ route('admin-seating-reservation-update', $reservation->id) }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Save Changes
						<i class="fa fa-floppy-o"></i>
					</button>
				</div>
			</div>

			<!-- Metaboxes -->
			<div class="row">
				
				<div class="col-sm-4 @if($errors->has('seat_id')) has-error @endif">

					<h4>Seat:</h4>
					
					<input type="text" class="form-control" id="seat" value="{{ $reservation->seat->name }}" autocomplete="off">
					<input type="text" class="hidden" id="seat_id" name="seat_id" value="{{ $reservation->seat->id }}">
					@if($errors->has('seat_id'))
						<p class="text-danger">{{ $errors->first('seat_id') }}</p>
					@endif

				</div>

				<div class="col-sm-4 @if($errors->has('seat_id')) has-error @endif">

					<h4>Reserved by:</h4>
					
					<input type="text" class="form-control" id="seat" value="{{ $reservation->reservedby->username.' ('.User::getFullnameByID($reservation->reservedby->id).')' }}" readonly="" disabled="">

				</div>
				
				<div class="col-sm-4 @if($errors->has('reservedfor')) has-error @endif">

					<h4>Reserved for:</h4>

					<input type="text" class="form-control" id="reservedfor" value="{{ $reservation->reservedfor->username.' ('.User::getFullnameByID($reservation->reservedfor->id).')' }}" autocomplete="off">
					<input type="text" class="hidden" id="reservedfor_id" name="reservedfor_id" value="{{ $reservation->reservedfor->id }}">
					@if($errors->has('reservedfor'))
						<p class="text-danger">{{ $errors->first('reservedfor') }}</p>
					@endif

				</div>
				
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>

	</div>
</div>

@stop

@section('javascript')
	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				$('#seat').typeahead({
					onSelect: function(item) {
						document.getElementById("seat_id").value = item.value;
						console.log("seat_id: " + item.value);
					},
					ajax: {
						url: "/ajax/seats",
						timeout: 500,
						displayField: "name",
						triggerLength: 1,
						method: "get",
					}
				});
				$('#reservedfor').typeahead({
					onSelect: function(item) {
						document.getElementById("reservedfor_id").value = item.value;
						console.log("reservedfor_id: " + item.value);
					},
					ajax: {
						url: "/ajax/usernames",
						timeout: 500,
						displayField: "name",
						triggerLength: 1,
						method: "get",
					}
				});
			 });
		})(jQuery);
	</script>
@stop