@extends('layouts.main')
@section('title', 'Reservations')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Reservations</h1>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('account') }}">Account</a></li>
				<li class="active"><strong>Reservations</strong></li>
			</ol>

			@if($reservations->count() == 0)
				<blockquote>
					<p><em>We can't find any data for you...</em></p>
				</blockquote>
			@else
				<table class="table">
					<thead>
						<th>ID</th>
						<th>Date</th>
						<th>Year</th>
						<th>Seat</th>
						<th>Reserved for</th>
						<th>Reserved by</th>
						<th>Details</th>
					</thead>
					<tbody>
						@foreach($reservations as $reservation)
							<tr>
								<td>{{ $reservation->id }}</td>
								<td>{{ date(User::getUserDateFormat(), strtotime($reservation->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($reservation->created_at)) }}</td>
								<td>{{ $reservation->year or 'N/A' }}</td>
								<td>{{ $reservation->seat->name or 'N/A' }}</td>
								<td>{{ User::getFullnameAndNicknameByID($reservation->reservedfor->id) }}</td>
								<td>{{ User::getFullnameAndNicknameByID($reservation->reservedby->id) }}</td>
								<td>@if($reservation->payment)<a href="{{ route('account-billing-payment', $reservation->payment->id) }}" class="btn btn-success btn-xs btn-icon icon-left"><i class="fa fa-money"></i>View Payment</a>@endif</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@endif
		</div>
	</div>
</div>
@stop