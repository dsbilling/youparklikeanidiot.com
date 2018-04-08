@extends('layouts.main')
@section('title', 'Show Brokenband - Admin')
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

		<h1 class="margin-bottom">Brokenband</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>Seating</li>
			<li>Brokenband</li>
			<li class="active"><strong>Show</strong></li>
		</ol>

		<br />

		<div class="row">
		
			<div class="col-md-12">

				<form action="{{ route('admin-seating-brokenband-store', $checkin->id) }}" method="post">

					<div class="row">
						<div class="col-sm-2 post-save-changes">
							<button type="submit" class="btn btn-warning btn-lg btn-block btn-icon" id="change">
								Change Broken Band
								<i class="fa fa-retweet"></i>
							</button>
						</div>
						
						<div class="col-sm-4 @if($errors->has('new_band_number')) has-error @endif">
							<input type="text" class="form-control input-lg" name="new_band_number" placeholder="New Band Number" value="{{ (old('new_band_number')) ? old('new_band_number') : '' }}" autocomplete="off" />
							@if($errors->has('new_band_number'))
								<p class="text-danger">{{ $errors->first('new_band_number') }}</p>
							@endif
						</div>

						<div class="col-sm-4 @if($errors->has('band_number')) has-error @endif">
							<input type="text" class="form-control input-lg disabled" value="Old Band Number: {{ $checkin->bandnumber }}" disabled="" />
							<input type="hidden" class="hidden" name="band_number" value="{{ $checkin->bandnumber }}" />
						</div>

						<div class="col-sm-2">
							<input type="text" class="form-control input-lg disabled" value="Checkin ID: {{ $checkin->id }}" disabled="" />
						</div>
						
					</div>

					<input type="hidden" name="_token" value="{{ csrf_token() }}">

				</form>

			</div>

		</div>
		<br />

	</div>
</div>

@stop