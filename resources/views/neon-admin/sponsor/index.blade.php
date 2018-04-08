@extends('layouts.main')
@section('title', 'Sponsor - Admin')
@section('css')
	<style>
		.hover_img a { position:relative; }
		.hover_img a span { position:absolute; display:none; z-index:99; }
		.hover_img a:hover span { display:block; }
		.hover_img img { background: rgba(255,255,255,0.8); padding: 3px; border: 1px rgba(0,0,0,0.8) solid; border-radius: 5px; }
	</style>
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Sponsor @if(Sentinel::hasAccess('admin.sponsor.create'))<a class="btn btn-lg btn-success btn-icon icon-left pull-right" href="{{ route('admin-sponsor-create') }}"><i class="fa fa-plus"></i> Add Sponsor</a>@endif</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li class="active"><strong>Sponsor</strong></li>
		</ol>
		
		<table class="table table-bordered table-hover datatable" id="table-1">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>URL</th>
					<th>Image</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($sponsors as $sponsor)
					<tr>
						<td scope="row">{{ $sponsor->name }}</td>
						<td>{{ $sponsor->description }}</td>
						<td><a href="{{ $sponsor->url }}" target="_blank">{{ $sponsor->url }}</a></td>
						<td><div class="hover_img"><a href="#">Hover to show image<span><img src="{{ $sponsor->image }}" alt="image" height="90" /></span></a></div></td>
						<td>
							<a href="{{ route('admin-sponsor-edit', $sponsor->id) }}" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>
							@if(Sentinel::hasAccess('admin.sponsor.destroy'))
								<a href="javascript:;" onclick="jQuery('#sponsor-destroy-{{ $sponsor->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

@foreach($sponsors as $sponsor)
	<div class="modal fade" id="sponsor-destroy-{{ $sponsor->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Sponsor:</strong> #{{ $sponsor->id }} - {{ $sponsor->name }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this sponsor?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-sponsor-destroy', $sponsor->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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