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
					<p class="text-center text-muted"><small><em>* Additional fee ({{ Setting::get('SEATING_SEAT_PRICE_ALT') - Setting::get('SEATING_SEAT_PRICE').' '.Setting::get('SEATING_SEAT_PRICE_CURRENCY') }}) and <a href="/tos">Terms</a> apply</em></small></p>
					<br>
					<h4 class="text-center text-muted"><em>~ or ~</em></h4>
					<br>

					<!-- CREDIT CARD FORM STARTS HERE -->
					<div class="card-wrapper" style="margin-bottom: 10px"></div>
					<div class="panel panel-default">
						<div class="panel-body">
							<form role="form" id="payment-form" method="post" action="{{ route('seating-charge', $currentseat->slug) }}">
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group @if($errors->has('number')) has-error @endif">
											<label for="number">CARD NUMBER</label>
											<div class="input-group">
												<input type="tel" class="form-control" name="number" placeholder="0000 0000 0000 0000" required autofocus value="{{ (old('number')) ? old('number') : '' }}" autocomplete="off" />
												<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-4 col-md-4">
										<div class="form-group @if($errors->has('expiryMonth')) has-error @endif">
											<label for="expiryMonth">EXP. MONTH</label>
											<input type="tel" class="form-control" name="expiryMonth" placeholder="MM" required value="{{ (old('expiryMonth')) ? old('expiryMonth') : '' }}" autocomplete="off" />
										</div>
									</div>
									<div class="col-xs-4 col-md-4">
										<div class="form-group @if($errors->has('expiryYear')) has-error @endif">
											<label for="expiryYear">EXP. YEAR</label>
											<input type="tel" class="form-control" name="expiryYear" placeholder="YY" required value="{{ (old('expiryYear')) ? old('expiryYear') : '' }}" autocomplete="off" />
										</div>
									</div>
									<div class="col-xs-4 col-md-4 pull-right">
										<div class="form-group @if($errors->has('cvc')) has-error @endif">
											<label for="cvc">CV CODE</label>
											<input type="tel" class="form-control" name="cvc" placeholder="CVC" required value="{{ (old('cvc')) ? old('cvc') : '' }}" autocomplete="off" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12">
										<div class="form-group @if($errors->has('name')) has-error @endif">
											<label for="name">NAME ON CARD</label>
											<input type="text" class="form-control" name="name" placeholder="John Doe" required value="{{ (old('name')) ? old('name') : '' }}" autocomplete="off" />
										</div>
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<button class="btn btn-success btn-lg btn-block" type="submit" id="pay"><i class='fa fa-money'></i> Pay Now</button>
										<div class="alert alert-info hidden" id="processing" style="margin-top: 5px">
											<i class='fa fa-circle-o-notch fa-spin'></i> Processing Payment
										</div>
									</div>
								</div>
								@if(count($errors->all()) > 0)
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

@section("javascript")
	<script type="text/javascript">
		jQuery(function ($) {
			$("#pay").prop("disabled", true);
			$("#payment-form input.form-control").prop("readonly", false);
			$('input').change(function() {
				if($(this).length > 0) {
					$("#pay").prop("disabled", true);
				}
				var anyFieldIsEmpty = $("#payment-form input").filter(function() { return $.trim(this.value).length === 0; }).length > 0;
				console.log(anyFieldIsEmpty);
				if (anyFieldIsEmpty === true) {
					$("#pay").prop("disabled", true);
				} else if (anyFieldIsEmpty === false) {
					$("#pay").prop("disabled", false);
				}
			});
			$('#pay').on('click', function() {
				$("#payment-form input.form-control").prop("readonly", true);
				$("#pay").prop("disabled", true);
				$("#processing").removeClass("hidden");
				$("#payment-form").submit();
			});
		});
	</script>
	
	<script src="{{ Theme::url('js/jquery.card.js') }}"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#payment-form').card({
				container: '.card-wrapper',
				formSelectors: {
					expiryInput: 'input[name="expiryMonth"], input[name="expiryYear"]'
				}
			});
		});
	</script>
@stop