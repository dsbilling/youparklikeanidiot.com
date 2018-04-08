@extends('layouts.main')
@section('title', 'Payment #'.$seatpayment->id.' - Billing')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Payment <small>#{{ $seatpayment->id }}</small></h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('account') }}">Account</a></li>
				<li>Billing</li>
				<li><a href="{{ route('account-billing-payments') }}">Payments</a></li>
				<li class="active"><strong>Payment #{{ $seatpayment->id }}</strong></li>
			</ol>

			<div class="row">
				<div class="col-md-4">
					
					<div class="card-wrapper" data-jp-card-initialized="true">
					   <div class="jp-card-container">
					      <div class="jp-card @if(in_array(strtolower($charge['source']['brand']), array('elo', 'visa', 'visaelectron', 'mastercard', 'maestro', 'amex', 'discover', 'dinersclub', 'dankkort', 'jcb'))){{ 'jp-card-'.strtolower($charge['source']['brand']).' jp-card-identified' }}@endif">
					         <div class="jp-card-front">
					            <div class="jp-card-logo jp-card-elo">
					               <div class="e">e</div>
					               <div class="l">l</div>
					               <div class="o">o</div>
					            </div>
					            <div class="jp-card-logo jp-card-visa">Visa</div>
					            <div class="jp-card-logo jp-card-visaelectron">
					               Visa
					               <div class="elec">Electron</div>
					            </div>
					            <div class="jp-card-logo jp-card-mastercard">Mastercard</div>
					            <div class="jp-card-logo jp-card-maestro">Maestro</div>
					            <div class="jp-card-logo jp-card-amex"></div>
					            <div class="jp-card-logo jp-card-discover">discover</div>
					            <div class="jp-card-logo jp-card-dinersclub"></div>
					            <div class="jp-card-logo jp-card-dankort">
					               <div class="dk">
					                  <div class="d"></div>
					                  <div class="k"></div>
					               </div>
					            </div>
					            <div class="jp-card-logo jp-card-jcb">
					               <div class="j">J</div>
					               <div class="c">C</div>
					               <div class="b">B</div>
					            </div>
					            <div class="jp-card-lower">
					               <div class="jp-card-shiny"></div>
					               <div class="jp-card-cvc jp-card-display">•••</div>
					               <div class="jp-card-number jp-card-display jp-card-invalid">•••• •••• •••• {{ $charge['source']['last4'] }}</div>
					               <div class="jp-card-name jp-card-display">{{ $charge['source']['name'] or 'Firstname Lastname' }}</div>
					               <div class="jp-card-expiry jp-card-display" data-before="month/year" data-after="valid
					                  thru">{{ $charge['source']['exp_month'] }}/{{ $charge['source']['exp_year'] }}</div>
					            </div>
					         </div>
					         <div class="jp-card-back">
					            <div class="jp-card-bar"></div>
					            <div class="jp-card-cvc jp-card-display">•••</div>
					            <div class="jp-card-shiny"></div>
					         </div>
					      </div>
					   </div>
					</div>

				</div>
				<div class="col-md-4">
					<h3>Payment</h3>
					<hr style="margin-top: 0">
					<p><strong>Date:</strong> {{ date(User::getUserDateFormat(), $charge['created']) .' at '. date(User::getUserTimeFormat(), $charge['created']) }}</p>
					<p><strong>Amount:</strong> {{ substr($charge['amount'], 0, -2) }}</p>
					<p><strong>Currency:</strong> {{ strtoupper($charge['currency']) }}</p>
					<p><strong>Paid:</strong> {{ ($charge['paid'] ? "Yes" : "No") }}</p>
					<p><strong>Refunded:</strong> {{ ($charge['refunded'] ? "Yes - ".substr($charge['amount_refunded'], 0, -2)." ".strtoupper($charge['currency']) : "No") }}</p>
					<p>
						<strong>Status:</strong>
						@if($charge['failure_message'])
							<a href="javascript:void(0);" class="btn btn-danger btn-xs popover-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $charge['failure_message'] }}" data-original-title="Failure Message">Failure</a>
						@else
							{{ ucfirst($charge['status']) }}
						@endif
					</p>
				</div>
				<div class="col-md-4">
					<?php $payment = \LANMS\SeatPayment::where('stripecharge', '=', $charge['id'])->with('reservation')->first(); ?>
					<h3>Reservation <a href="{{ route('account-reservation-view', $payment->reservation->id) }}" class="btn btn-info btn-xs btn-icon icon-left pull-right"><i class="fa fa-info-circle"></i>View Reservation</a></h3>
					<hr style="margin-top: 0">
					@if($charge)
						<p><strong>ID:</strong> {{ $payment->reservation->id }}</p>
						<p><strong>Year:</strong> {{ $payment->reservation->year }}</p>
						<p><strong>Seat:</strong> {{ $payment->reservation->seat->name }}</p>
						<p><strong>Reserved for:</strong> {{ User::getFullnameAndNicknameByID($payment->reservation->reservedfor->id) }}</p>
						<p><strong>Reserved by:</strong> {{ User::getFullnameAndNicknameByID($payment->reservation->reservedby->id) }}</p>
					@else
						<em>N/A</em>
					@endif
					
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section("javascript")
	<script src="{{ Theme::url('js/jquery.card.js') }}"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$('#payment-form').card({
				container: '.card-wrapper'
			});
		});
	</script>
@stop