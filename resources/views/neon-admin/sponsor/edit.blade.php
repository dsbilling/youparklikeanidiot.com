@extends('layouts.main')
@section('title', 'Edit Sponsor - '.$sponsor->name.' - Admin')
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

		<h1 class="margin-bottom">Edit Sponsor: <small>{{ $sponsor->name }}</small></h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-sponsor') }}">Sponsor</a></li>
			<li class="active"><strong>Edit Sponsor: {{ $sponsor->name }}</strong></li>
		</ol>

		<form action="{{ route('admin-sponsor-update', $sponsor->id) }}" method="post" enctype="multipart/form-data">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Save Changes
						<i class="fa fa-floppy-o"></i>
					</button>
				</div>

				<div class="col-sm-5">
					<div class="panel panel-primary @if($errors->has('name')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Name</div>
						</div>
						<div class="panel-body">
							<input type="text" class="form-control input-lg" name="name" placeholder="Alphabet Inc." value="{{ (old('name')) ? old('name') : $sponsor->name }}" />
							@if($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif
						</div>
					</div>
				</div>
				
				<div class="col-sm-5">
					<div class="panel panel-primary @if($errors->has('url')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">URL <small>*Optional</small></div>
						</div>
						<div class="panel-body">
							<input type="text" class="form-control input-lg" name="url" placeholder="https://abc.xyz (*Optional)" value="{{ (old('url')) ? old('url') : $sponsor->url }}" />
							@if($errors->has('url'))
								<p class="text-danger">{{ $errors->first('url') }}</p>
							@endif
						</div>
					</div>
				</div>
			</div>

			<br>

			<div class="row">
				<div class="col-sm-5">
					<div class="panel panel-primary @if($errors->has('description')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Description <small>*Optional</small></div>
						</div>
						<div class="panel-body">
							<textarea class="form-control input-lg" name="description" placeholder="Alphabet is providing network services for the whole event.">{{ (old('description')) ? old('description') : $sponsor->description }}</textarea>
							@if($errors->has('description'))
								<p class="text-danger">{{ $errors->first('description') }}</p>
							@endif
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="panel panel-primary @if($errors->has('image')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Logo</div>
						</div>
						<div class="panel-body">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="max-width: 335px; height: 90px;" data-trigger="fileinput">
									<img src="{{ $sponsor->image }}" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 335px; height: 90px;"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="image" accept="image/*">
									</span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
							@if($errors->has('image'))
								<p class="text-danger">{{ $errors->first('image') }}</p>
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
	<script src="{{ Theme::url('js/jquery.inputmask.bundle.min.js') }}"></script>
	<script src="{{ Theme::url('js/selectboxit/jquery.selectBoxIt.min.js') }}"></script>
	<script src="{{ Theme::url('js/bootstrap-tagsinput.min.js') }}"></script>
@stop