@extends('layouts.main')
@section('title', 'Address Book')
@section('css')
	<style type="text/css">
		.page-container.horizontal-menu header.navbar.navbar-fixed-top {
			z-index: 0;
		}
		.modal-dialog {
			padding-top: 90px;
		}
	</style>
@stop
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			
			<h2>Address Book<a class="btn btn-sm btn-success pull-right" href="{{ route('account-addressbook-create') }}"><i class="fa fa-plus"></i> Add</a></h2>
			<ol class="breadcrumb 2" >
				<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
				<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
				<li><a href="{{ route('account') }}">Account</a></li>
				<li class="active"><strong>Address Book</strong></li>
			</ol>

			<div class="row">
				<div class="col-lg-12">
					@if(Sentinel::getUser()->reservations->count() <> 0)
						<div class="alert alert-info" role="alert"><strong>Information!</strong> You will not be able to delete any addresses while you have reserved seats.</div>
					@endif
					@if($addresses->count() == 0)
						<blockquote>
							<p><em>We can't find any addresses tied to your account. You should <a href="{{ route('account-addressbook-create') }}">add</a> one.</em></p>
						</blockquote>
					@else
						<?php $i=0; ?>
						@foreach($addresses as $address)
							<?php $i++; ?>
							<div class="col-lg-3">
								<div class="panel @if($address->main_address) panel-info @else panel-default @endif">
									<div class="panel-heading">
										<h3 class="panel-title">Address #{{ $i }}@if($address->main_address) <small>Primary</small>@endif</h3>
									</div>
									<div class="panel-body">
										<address>
											<strong>{{ $address->address1 }}</strong>@if($address->address2), {{ $address->address2 }}@endif<br>
											{{ $address->postalcode }}, {{ $address->city }}<br>
											{{ $address->county }}<br>
											{{ $address->country }}
										</address>
										<p>
											<a class="btn btn-xs btn-warning btn-icon icon-left" href="{{ route('account-addressbook-edit', $address->id) }}"><i class="fa fa-pencil"></i> Edit</a>
											@if(Sentinel::getUser()->reservations->count() == 0)
												<a href="javascript:;" onclick="jQuery('#address-destroy-{{ $address->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-xs btn-icon icon-left"><i class="fa fa-times"></i>Delete</a>
											@endif
										</p>
									</div>
								</div>
							</div>
						@endforeach

					@endif
				</div>
			</div>

		</div>
	</div>
</div>
@if(Sentinel::getUser()->reservations->count() == 0)
	@foreach($addresses as $address)
		<div class="modal fade" id="address-destroy-{{ $address->id }}" data-backdrop="static">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><strong>Delete Address:</strong> {{ $address->address1 }}</h4>
					</div>
					<div class="modal-body">
						<h4 class="text-danger text-center"><strong>Are you sure you want to delete this address?</strong></h4>
					</div>
					<div class="modal-footer">
						<a href="{{ route('account-addressbook-destroy', $address->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
						<button type="button" class="btn btn-success" data-dismiss="modal">No, take me away!</button>
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endif

@stop