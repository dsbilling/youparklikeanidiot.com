@extends('layouts.main')
@section('title', 'Create Skill - Admin')
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

		<h1 class="margin-bottom">Create Skill</h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-crew') }}">Crew</a></li>
			<li><a href="{{ route('admin-crew-skill') }}">Skill</a></li>
			<li class="active"><strong>Create Skill</strong></li>
		</ol>
					
		<br />
		
		<form action="{{ route('admin-crew-skill-store') }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Create
						<i class="fa fa-check"></i>
					</button>
				</div>
				
				<div class="col-sm-5 @if($errors->has('title')) has-error @endif">
					<div class="input-group">
						<div class="input-group-addon">
							Title
						</div>
						<input type="text" class="form-control input-lg" name="title" placeholder="Skill title" value="{{ (old('title')) ? old('title') : '' }}" />
					</div>
					@if($errors->has('title'))
						<p class="text-danger">{{ $errors->first('title') }}</p>
					@endif
				</div>

				<div class="col-sm-5 @if($errors->has('slug')) has-error @endif">
					<div class="input-group">
						<div class="input-group-addon">
							Slug (Optional)
						</div>
						<input type="text" class="form-control input-lg" placeholder="Slug (Optional)" value="{{ (old('slug')) ? old('slug') : '' }}" name="slug">
					</div>
					@if($errors->has('slug'))
						<p class="text-danger">{{ $errors->first('slug') }}</p>
					@endif
				</div>

			</div>
			<div class="row">

				<hr>

				<div class="col-sm-5 @if($errors->has('icon')) has-error @endif">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-font-awesome"></i>
						</div>
						<input type="text" class="form-control input-lg" placeholder="Icon" value="{{ (old('icon')) ? old('icon') : '' }}" name="icon">
					</div>
					<p>Icons can be found here: <a href="http://fontawesome.io/icons/" target="_blank">fontawesome.io/icons</a></p>
					@if($errors->has('icon'))
						<p class="text-danger">{{ $errors->first('icon') }}</p>
					@endif
				</div>

				<div class="col-sm-5 @if($errors->has('label')) has-error @endif">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-fonticons"></i>
						</div>
						<input type="text" class="form-control input-lg" placeholder="Label" value="{{ (old('label')) ? old('label') : 'label label-default' }}" name="label">
					</div>
					<p>Available labels can be found here: <a href="https://getbootstrap.com/docs/3.3/components/#available-variations" target="_blank">getbootstrap.com</a></p>
					@if($errors->has('label'))
						<p class="text-danger">{{ $errors->first('label') }}</p>
					@endif
				</div>

			</div>
			
			<br />

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