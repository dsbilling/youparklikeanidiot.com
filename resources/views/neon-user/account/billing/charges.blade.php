@extends('layouts.main')
@section('title', 'Charges - Billing')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Charges</h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('account') }}">Account</a></li>
				<li>Billing</li>
				<li class="active"><strong>Charges</strong></li>
			</ol>

			<table class="table">
				<thead>
					<th>Date</th>
					<th>Amount</th>
					<th>Currency</th>
					<th>Cardnumber</th>
					<th>Card Exp.</th>
					<th>Paid</th>
					<th>Refunded</th>
					<th>Status</th>
					<th>Linked to payment</th>
				</thead>
				<tbody>
					@foreach($charges as $charge)
						<tr>
							<td>{{ date(User::getUserDateFormat(), $charge['created']) .' at '. date(User::getUserTimeFormat(), $charge['created']) }}</td>
							<td>{{ substr($charge['amount'], 0, -2) }}</td>
							<td>{{ strtoupper($charge['currency']) }}</td>
							<td><em>xxxx xxxx xxxx</em> {{ $charge['source']['last4'] }}</td>
							<td>{{ $charge['source']['exp_month'] }} / {{ $charge['source']['exp_year'] }}</td>
							<td>{{ ($charge['paid'] ? "Yes" : "No") }}</td>
							<td>{{ ($charge['refunded'] ? "Yes - ".substr($charge['amount_refunded'], 0, -2)." ".strtoupper($charge['currency']) : "No") }}</td>
							<td>
								@if($charge['failure_message'])
									<a href="javascript:void(0);" class="btn btn-danger btn-xs popover-danger" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="{{ $charge['failure_message'] }}" data-original-title="Failure Message">Failure</a>
								@else
									{{ ucfirst($charge['status']) }}
								@endif
							</td>
							<td>
								<?php $seatpayment = \LANMS\SeatPayment::where('stripecharge', '=', $charge['id'])->first(); ?>
								@if($seatpayment)
									<a href="{{ route('account-billing-payment', $seatpayment->id) }}" class="btn btn-info btn-xs btn-icon icon-left"><i class="fa fa-info-circle"></i>View</a>
								@else
									<em>N/A</em>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop