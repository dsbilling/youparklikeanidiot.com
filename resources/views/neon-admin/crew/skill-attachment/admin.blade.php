@extends('layouts.main')
@section('title', 'Crew Skill Attachments - Admin')
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Crew Skill Attachments @if(Sentinel::hasAccess('admin.crew-skill.create'))<a class="btn btn-lg btn-success btn-icon icon-left pull-right" href="{{ route('admin-crew-skill-attachment-create') }}"><i class="fa fa-plus"></i> Create Skill Attachment</a>@endif</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-crew') }}">Crew</a></li>
			<li class="active"><strong>Skill Attachments</strong></li>
		</ol>

		<br />
		
		<table class="table table-bordered table-hover datatable" id="table-1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Skill</th>
					<th>Year</th>
					<th>Created at</th>
					<th>Created by</th>
					<th>Edited at</th>
					<th>Edited by</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($skillattachments as $skilla)
					<tr>
						<th scope="row">{{ $skilla->id }}</th>
						<td>{{ User::getFullnameByID($skilla->user->id) }}</td>
						<td><small><span class="{{ $skilla->skill->label }}"><i class="{{ $skilla->skill->icon }}"></i> {{ $skilla->skill->title }}</span></small></td>
						<td>{{ $skilla->year }}</td>
						<td>{{ date(User::getUserDateFormat(), strtotime($skilla->created_at)) .' at '. date(User::getUserTimeFormat(), strtotime($skilla->created_at)) }}</td>
						<td><a href="{{ URL::route('user-profile', $skilla->author->username) }}">{{ User::getFullnameByID($skilla->author->id) }}</a></td>
						<td>{{ date(User::getUserDateFormat(), strtotime($skilla->updated_at)) .' at '. date(User::getUserTimeFormat(), strtotime($skilla->updated_at)) }}</td>
						<td><a href="{{ URL::route('user-profile', $skilla->editor->username) }}">{{ User::getFullnameByID($skilla->editor->id) }}</a></td>
						<td>
							<a href="{{ route('admin-crew-skill-attachment-edit', $skilla->id) }}" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>
							@if(Sentinel::hasAccess('admin.crew-skill.destroy'))
								<a href="javascript:;" onclick="jQuery('#skilla-destroy-{{ $skilla->id }}').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</div>

@foreach($skillattachments as $skilla)
	<div class="modal fade" id="skilla-destroy-{{ $skilla->id }}" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><strong>Delete Category:</strong> #{{ $skilla->id }}</h4>
				</div>
				<div class="modal-body">
					<h4 class="text-danger text-center"><strong>Are you sure you want to delete this skill attachment?</strong></h4>
				</div>
				<div class="modal-footer">
					<a href="{{ route('admin-crew-skill-attachment-destroy', $skilla->id) }}" class="btn btn-danger">Yes, I want to delete it.</a>
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