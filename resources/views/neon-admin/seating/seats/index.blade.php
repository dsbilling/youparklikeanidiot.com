@extends('layouts.main')
@section('title', 'Seats - Admin')
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Seats @if(Sentinel::hasAccess('admin.seating.seat.create'))<a class="btn btn-lg btn-success btn-icon icon-left pull-right" href="{{ route('admin-seating-seat-create') }}"><i class="fa fa-plus"></i> Create Seat</a>@endif</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>Seating</li>
			<li class="active"><strong>Seats</strong></li>
		</ol>

		<br />
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered table-hover datatable" id="table-1">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Slug</th>
							<th>Row</th>
							<th>Created at</th>
							<th>Created by</th>
							<th>Updated at</th>
							<th>Updated by</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($allseats as $seat)
							<tr>
								<th scope="row">{{ $seat->id }}</th>
								<td>{{ $seat->name }}</td>
								<td>{{ $seat->slug }}</td>
								<td>{{ $seat->row->name or 'N/A' }}</td>
								<td>{{ date(User::getUserDateFormat(), strtotime($seat->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($seat->created_at)) }}</td>
								<td><a href="{{ URL::route('user-profile', $seat->author->username) }}">{{ User::getFullnameByID($seat->author->id) }}</a></td>
								<td>{{ date(User::getUserDateFormat(), strtotime($seat->updated_at)) .' at '. date(User::getUserTimeFormat(), strtotime($seat->updated_at)) }}</td>
								<td><a href="{{ URL::route('user-profile', $seat->editor->username) }}">{{ User::getFullnameByID($seat->editor->id) }}</a></td>
								<td>
									<a href="{{ route('admin-seating-seat-edit', $seat->id) }}" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>
									@if(Sentinel::hasAccess('admin.seating.seat.destroy'))
										<a href="javascript:;" onclick="jQuery('#seat-destroy-{{ $seat->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
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

@foreach($allseats as $seat)
	<div class="modal fade" id="seat-destroy-{{ $seat->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Seat:</strong> #{{ $seat->id }} - {{ $seat->name }}</h4>
				</div>
				<div class="modal-body text-center">
					<h4 class="text-danger"><strong>Are you sure you want to delete this seat?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-seating-seat-destroy', $seat->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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
				    fnSeatsCallback  : function (nSeats, aData, iDisplayIndex, iDisplayIndexFull) {
				        responsiveHelper.createExpandIcon(nSeats);
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