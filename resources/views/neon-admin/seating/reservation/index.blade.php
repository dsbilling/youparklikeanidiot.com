@extends('layouts.main')
@section('title', 'Reservations - Admin')
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Reservations</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>Seating</li>
			<li class="active"><strong>Reservations</strong></li>
		</ol>

		<br />
		<div class="row">
			<div class="col-md-4">
				@include('seating.seatmap')
			</div>
			<div class="col-md-8">
				<table class="table table-bordered table-hover datatable" id="table-1">
					<thead>
						<tr>
							<th>ID</th>
							<th>Seat</th>
							<th>Ticket ID</th>
							<th>Reserved for</th>
							<th>Reserved by</th>
							<th>Reserved at</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($reservations as $reservation)
							<tr>
								<th scope="row">{{ $reservation->id }}</th>
								<td>{{ $reservation->seat->name }}</td>
								<td>{{ $reservation->ticket->barcode or 'N/A' }}</td>
								<td><a href="{{ URL::route('user-profile', $reservation->reservedfor->username) }}">{{ User::getFullnameByID($reservation->reservedfor->id) }}</a></td>
								<td><a href="{{ URL::route('user-profile', $reservation->reservedby->username) }}">{{ User::getFullnameByID($reservation->reservedby->id) }}</a></td>
								<td>{{ date(User::getUserDateFormat(), strtotime($reservation->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($reservation->created_at)) }}</td>
								<td>
									<a href="{{ route('admin-seating-reservation-edit', $reservation->id) }}" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.reservation.destroy'))
										<a href="javascript:;" onclick="jQuery('#reservation-destroy-{{ $reservation->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
									@endif
									<a href="{{ route('admin-seating-reservation-show', $reservation->seat->slug) }}" class="btn btn-info btn-sm btn-icon icon-left"><i class="entypo-info"></i>View</a>
									@if($reservation->ticket)
										<a href="{{ route('admin-seating-reservation-pdf', $reservation->seat->slug) }}" class="btn btn-default btn-sm btn-icon icon-left"><i class="fa fa-file-pdf-o"></i>Ticket</a>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		

	</div>
</div>

@foreach($reservations as $reservation)
	<div class="modal fade" id="reservation-destroy-{{ $reservation->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Reservation:</strong> #{{ $reservation->id }}</h4>
				</div>
				<div class="modal-body text-center">
					<h4 class="text-danger"><strong>Are you sure you want to delete this reservation?</strong></h4>
					<p><strong>Seat:</strong> {{ $reservation->seat->name }}</p>
					<p><strong>Reserved for:</strong> {{ User::getFullnameByID($reservation->reservedfor->id) }}</p>
					<p><strong>Reserved by:</strong> {{ User::getFullnameByID($reservation->reservedfor->id) }}</p>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-seating-reservation-destroy', $reservation->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
					<button type="button" class="btn btn-success" data-dismiss="modal">No, take me away!</button>
				</div>
			</div>
		</div>
	</div>
@endforeach

@stop

@section('javascript')
	
	<script src="{{ Theme::url('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ Theme::url('js/datatables/TableTools.min.js') }}"></script>
	<script src="{{ Theme::url('js/dataTables.bootstrap.js') }}"></script>
	<script src="{{ Theme::url('js/datatables/jquery.dataTables.columnFilter.js') }}"></script>
	<script src="{{ Theme::url('js/datatables/lodash.min.js') }}"></script>
	<script src="{{ Theme::url('js/datatables/responsive/js/datatables.responsive.js') }}"></script>
	<script type="text/javascript">
		var responsiveHelper;
		var breakpointDefinition = {
		    tablet: 1024,
		    phone : 480
		};
		var tableContainer;
		
			jQuery(document).ready(function($)
			{
				tableContainer = $("#table-1");
				
				tableContainer.dataTable({
					"sPaginationType": "bootstrap",
					"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
					"bStateSave": true,
					
		
				    // Responsive Settings
				    bAutoWidth     : false,
				    fnPreDrawCallback: function () {
				        // Initialize the responsive datatables helper once.
				        if (!responsiveHelper) {
				            responsiveHelper = new ResponsiveDatatablesHelper(tableContainer, breakpointDefinition);
				        }
				    },
				    fnRowCallback  : function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
				        responsiveHelper.createExpandIcon(nRow);
				    },
				    fnDrawCallback : function (oSettings) {
				        responsiveHelper.respond();
				    }
				});
				
				$(".dataTables_wrapper select").select2({
					minimumResultsForSearch: -1
				});
			});
	</script>
@stop