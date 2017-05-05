@extends('layouts.main')
@section('title', 'Create Article - Admin')
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

		<h1 class="margin-bottom">Create Category</h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-news') }}">News</a></li>
			<li><a href="{{ route('admin-news-category') }}">News</a></li>
			<li class="active"><strong>Create Category</strong></li>
		</ol>
					
		<br />
		
		<form action="{{ route('admin-news-category-store') }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Create
						<i class="fa fa-check"></i>
					</button>
				</div>
				
				<div class="col-sm-5 @if($errors->has('name')) has-error @endif">
					<input type="text" class="form-control input-lg" name="name" placeholder="Category name" value="{{ (old('name')) ? old('name') : '' }}" />
					@if($errors->has('name'))
						<p class="text-danger">{{ $errors->first('name') }}</p>
					@endif
				</div>

				<div class="col-sm-5 @if($errors->has('slug')) has-error @endif">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-header"></i>
						</div>
						<input type="text" class="form-control input-lg" placeholder="Slug (Optional)" value="{{ (old('slug')) ? old('slug') : '' }}" name="slug">
					</div>
					@if($errors->has('slug'))
						<p class="text-danger">{{ $errors->first('slug') }}</p>
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