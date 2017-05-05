@extends('layouts.main')
@section('title', 'Visitor Check-in - Admin')
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

		<h1 class="margin-bottom">Visitor Check-in</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-seating') }}">Seating</a></li>
			<li class="active"><strong>Visitor Check-in</strong></li>
		</ol>

		<br />
		
		<form action="{{ route('admin-seating-checkin-visitor-store') }}" method="post">

			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Check-in
						<i class="fa fa-check"></i>
					</button>
				</div>
				
				<div class="col-sm-4 @if($errors->has('fullname')) has-error @endif">
					<input type="text" class="form-control input-lg" name="fullname" placeholder="Full Name" value="{{ (old('fullname')) ? old('fullname') : '' }}" autocomplete="off" />
					@if($errors->has('fullname'))
						<p class="text-danger">{{ $errors->first('fullname') }}</p>
					@endif
				</div>

				<div class="col-sm-4 @if($errors->has('telephonenumber')) has-error @endif">
					<input type="tel" class="form-control input-lg" name="telephonenumber" placeholder="Telephone Number" value="{{ (old('telephonenumber')) ? old('telephonenumber') : '' }}" autocomplete="off" />
					@if($errors->has('telephonenumber'))
						<p class="text-danger">{{ $errors->first('telephonenumber') }}</p>
					@endif
				</div>

				<div class="col-sm-2 @if($errors->has('bandnumber')) has-error @endif">
					<input type="text" class="form-control input-lg" name="bandnumber" placeholder="Band Number" value="{{ (old('bandnumber')) ? old('bandnumber') : '' }}" autocomplete="off" />
					@if($errors->has('bandnumber'))
						<p class="text-danger">{{ $errors->first('bandnumber') }}</p>
					@endif
				</div>
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>

		<br><hr><br>

		<div class="row">

			<div class="col-md-6">

				<h1 class="text-center">{{ Visitor::all()->count() }}<br><small>Visitors has checked-in</small></h1>
				<hr>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Telephone Number</th>
							<th>Band #</th>
							<th>Ticket Expires</th>
						</tr>
					</thead>
					<tbody>
						@foreach($visitors as $visitor)	
							<tr>
								<td>{{ $visitor->fullname }}</td>
								<td>{{ $visitor->phonenumber }}</td>
								<td>{{ $visitor->bandnumber }}</td>
								<td>{{ Visitor::getExpireTime($visitor->id) }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			

		</div>

	</div>
</div>

@stop