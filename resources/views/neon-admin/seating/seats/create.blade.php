@extends('layouts.main')
@section('title', 'Create Seat - Admin')
@section('css')
	<style>
		.ms-container .ms-list {
			width: 135px;
			height: 205px;
		}
		
		.post-save-changes {
			float: right;
		}
		
		@media screen and (max-width: 789px)
		{
			.post-save-changes {
				float: none;
				margin-bottom: 20px;
			}
		}
	</style>
	<link rel="stylesheet" href="{{ Theme::url('js/wysihtml5/bootstrap-wysihtml5.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('js/selectboxit/jquery.selectBoxIt.css') }}">
	<link rel="stylesheet" href="{{ Theme::url('css/bootstrap-datetimepicker.min.css') }}">
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Create Seat</h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>Seating</li>
			<li><a href="{{ route('admin-seating-seats') }}">Seats</a></li>
			<li class="active"><strong>Create Seat</strong></li>
		</ol>

		<form action="{{ route('admin-seating-seat-store') }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Create
						<i class="fa fa-check"></i>
					</button>
				</div>

				<div class="col-sm-5">
					<div class="panel panel-primary @if($errors->has('name')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Name</div>
						</div>
						<div class="panel-body">
							<input type="text" class="form-control input-lg" name="name" placeholder="A1" value="{{ (old('name')) ? old('name') : '' }}" />
							@if($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif
						</div>
					</div>
				</div>

				<div class="col-sm-5">
					<div class="panel panel-primary @if($errors->has('row_id')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Row</div>
						</div>
						<div class="panel-body">
							<input type="text" class="form-control input-lg" id="row" placeholder="A" value="" autocomplete="off" />
							<input type="text" class="hidden" id="row_id" name="row_id" value="0">
							@if($errors->has('row_id'))
								<p class="text-danger">{{ $errors->first('row_id') }}</p>
							@endif
						</div>
					</div>
				</div>
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>

	</div>
</div>

@stop

@section('javascript')
	<script src="{{ Theme::url('js/wysihtml5/wysihtml5-0.4.0pre.min.js') }}"></script>
	<script src="{{ Theme::url('js/wysihtml5/bootstrap-wysihtml5.js') }}"></script>
	<script src="{{ Theme::url('js/jquery.multi-select.js') }}"></script>
	<script src="{{ Theme::url('js/fileinput.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ Theme::url('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>

	<script src="{{ Theme::url('js/bootstrap-typeahead.min.js') }}"></script>
	<script type="text/javascript">
		(function($) {
			$(document).ready( function() { 
				$('#row').typeahead({
					onSelect: function(item) {
						document.getElementById("row_id").value = item.value;
						console.log(item.value);
					},
					ajax: {
						url: "/ajax/rows",
						timeout: 500,
						displayField: "name",
						triggerLength: 1,
						method: "get",
					}
				});
			 });
		})(jQuery);
	</script>
@stop