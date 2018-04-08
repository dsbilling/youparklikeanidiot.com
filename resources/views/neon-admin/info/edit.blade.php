@extends('layouts.main')
@section('title', 'Edit Info - '.$info->name.' - Admin')
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

		<h1 class="margin-bottom">Edit Info: <small>{{ $info->name }}</small></h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>info</li>
			<li class="active"><strong>Edit Info: {{ $info->name }}</strong></li>
		</ol>

		<form action="{{ route('admin-info-update', $info->id) }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Save Changes
						<i class="fa fa-floppy-o"></i>
					</button>
				</div>
				
				<div class="col-sm-10 @if($errors->has('content')) has-error @endif">
					<input type="text" class="form-control input-lg" name="content" placeholder="Setting Value" value="{{ (old('content')) ? old('content') : $info->content }}" />
					@if($errors->has('content'))
						<p class="text-danger">{{ $errors->first('content') }}</p>
					@endif
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
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.min.js') }}"></script>
	<script src="{{ Theme::url('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap-tagsinput.min.js') }}"></script>
@stop