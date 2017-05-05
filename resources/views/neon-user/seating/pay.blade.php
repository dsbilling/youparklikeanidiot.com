@extends('layouts.main')
@section('title', 'Pay Reservation - '.$currentseat->name)
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/creditcard.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Pay Reservation - {{ $currentseat->name }}</h1>

			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('account') }}">Dashboard</a></li>
				<li><a href="{{ route('seating') }}">Seating</a></li>
				<li class="active"><strong>Pay Reservation - {{ $currentseat->name }}</strong></li>
			</ol>

			<div class="row">	
				<div class="col-md-8">

					@if(Setting::get('SEATING_SHOW_MAP'))
						@include('seating.seatmap')
					@else
						<h2>Seatmap is not available at this moment!</h2>
						<p>Please check back later...</p>
					@endif

				</div>
				<div class="col-md-4">
					<h1 class="text-center"><small>Price:</small><br>{{ Setting::get('SEATING_SEAT_PRICE') }} {{ Setting::get('SEATING_SEAT_PRICE_CURRENCY') }}</h1>
					<hr>
					<a class="btn btn-info btn-lg btn-block" href="{{ route('seating-paylater', $currentseat->slug) }}">Pay at the Entrance<em>*</em></a>
					<p class="text-center text-muted"><small><em>* Additional fee and <a href="/tos">Terms</a> apply</em></small></p>
					<br>
					<h4 class="text-center text-muted"><em>~ or ~</em></h4>
					<br>
					<!-- CREDIT CARD FORM STARTS HERE -->
					<div class="panel panel-default credit-card-box">
						<div class="panel-heading display-table">
							<div class="row display-tr">
								<h3 class="panel-title display-td">Payment Details</h3>
								<div class="display-td">
									<img class="img-responsive pull-right" src="{{ Theme::url('images/creditcards.png') }}">
								</div>
							</div>
						</div>
						<div class="panel-body">
							<form role="form" id="payment-form" method="post" action="{{ route('seating-charge', $currentseat->slug) }}">
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group @if($errors->has('cardNumber')) has-error @endif">
											<label for="cardNumber">CARD NUMBER</label>
											<div class="input-group">
												<input type="tel" class="form-control" name="cardNumber" placeholder="Valid Card Number" required autofocus value="{{ (old('cardNumber')) ? old('cardNumber') : '' }}" autocomplete="off" />
												<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-4 col-md-4">
										<div class="form-group @if($errors->has('cardMonthExpiry')) has-error @endif">
											<label for="cardMonthExpiry">EXP. MONTH</label>
											<input type="tel" class="form-control" name="cardMonthExpiry" placeholder="MM" required value="{{ (old('cardMonthExpiry')) ? old('cardMonthExpiry') : '' }}" autocomplete="off" />
										</div>
									</div>
									<div class="col-xs-4 col-md-4">
										<div class="form-group @if($errors->has('cardYearExpiry')) has-error @endif">
											<label for="cardYearExpiry">EXP. YEAR</label>
											<input type="tel" class="form-control" name="cardYearExpiry" placeholder="YY" required value="{{ (old('cardYearExpiry')) ? old('cardYearExpiry') : '' }}" autocomplete="off" />
										</div>
									</div>
									<div class="col-xs-4 col-md-4 pull-right">
										<div class="form-group @if($errors->has('cardCVC')) has-error @endif">
											<label for="cardCVC">CV CODE</label>
											<input type="tel" class="form-control" name="cardCVC" placeholder="CVC" required value="{{ (old('cardCVC')) ? old('cardCVC') : '' }}" autocomplete="off" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<button class="btn btn-success btn-lg btn-block" type="submit">Pay Now</button>
									</div>
								</div>
								@if ($errors->has())
									<br>
									<div class="alert alert-danger">
										@foreach ($errors->all() as $error)
											{{ $error }}<br>
										@endforeach
									</div>
								@endif
							</form>
						</div>
					</div>
					<!-- CREDIT CARD FORM ENDS HERE -->
				</div>
		</div>
	</div>
</div>
@stop