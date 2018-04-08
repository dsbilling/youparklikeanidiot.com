@extends('layouts.main')
@section('title', 'Edit Article - '.$article->title.' - Admin')
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

		<h1 class="margin-bottom">Edit Article: <small>{{ $article->title }}</small></h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li><a href="{{ route('admin-news') }}">News</a></li>
			<li class="active"><strong>Edit Article #{{ $article->id }}</strong></li>
		</ol>
					
		<br />
		
		<form action="{{ route('admin-news-update', $article->id) }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Save Changes
						<i class="fa fa-floppy-o"></i>
					</button>
				</div>
				
				<div class="col-sm-10 @if($errors->has('title')) has-error @endif">
					<input type="text" class="form-control input-lg" name="title" placeholder="Article title" value="{{ (old('title')) ? old('title') : $article->title }}" />
					@if($errors->has('title'))
						<p class="text-danger">{{ $errors->first('title') }}</p>
					@endif
				</div>
			</div>
			
			<br />

			<!-- WYSIWYG - Content Editor -->
			<div class="row">
				<div class="col-sm-12 @if($errors->has('content')) has-error @endif">
					<textarea class="form-control wysihtml5" rows="18" data-stylesheet-url="{{ Theme::url('css/wysihtml5-color.css ') }}" name="content">
						{{ (old('content')) ? old('content') : $article->content }}
					</textarea>
					@if($errors->has('content'))
						<p class="text-danger">{{ $errors->first('content') }}</p>
					@endif
				</div>
			</div>
			
			<br />

			<!-- Metaboxes -->
			<div class="row">
				
				<!-- Metabox :: Publish Settings -->
				<div class="col-sm-4">
					
					<div class="panel panel-primary @if($errors->has('active')) panel-danger @endif" data-collapsed="0">
				
						<div class="panel-heading">
							<div class="panel-title">
								Publish Settings
							</div>
							
						</div>
						
						<div class="panel-body">
							
							<div class="checkbox checkbox-replace @if($errors->has('active')) text-danger @endif">
								<input type="checkbox" name="active" @if($article->active) checked @endif>
								<label>Show on frontpage</label>
								<p><small><em>Will be visible on the users dashboard if checked or not</em></small></p>
								@if($errors->has('active'))
									<p class="text-danger">{{ $errors->first('active') }}</p>
								@endif
							</div>
							
							<br />

							<div class="row">
								<div class="col-md-6">
									<p>Publish Date</p>
									<div class="input-group">
										<input type="text" class="form-control datepicker @if($errors->has('published_at_date')) has-error @endif" value="{{ (old('published_at_date')) ? old('published_at_date') : date('D, d F Y', strtotime($article->published_at)) }}" data-format="D, dd MM yyyy" name="published_at_date">
										<div class="input-group-addon">
											<a href="javascript:void(0);"><i class="fa fa-calendar"></i></a>
										</div>
										@if($errors->has('published_at_date'))
											<p class="text-danger">{{ $errors->first('published_at_date') }}</p>
										@endif
									</div>
								</div>
								<div class="col-md-6">
									<p>Publish Time</p>
									<div class="input-group">
										<input type="text" class="form-control @if($errors->has('published_at_time')) has-error @endif" value="{{ (old('published_at_time')) ? old('published_at_time') : date('H:i', strtotime($article->published_at)) }}" data-mask="h:s" name="published_at_time">
										<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</div>
										@if($errors->has('published_at_time'))
											<p class="text-danger">{{ $errors->first('published_at_time') }}</p>
										@endif
									</div>
								</div>
							</div>
									
						</div>
					
					</div>
					
				</div>
				
				<!--<div class="col-sm-4">
					
					<div class="panel panel-primary @if($errors->has('image')) panel-danger @endif" data-collapsed="0">
				
						<div class="panel-heading">
							<div class="panel-title">
								Featured Image
							</div>
							
							
						</div>
						
						<div class="panel-body">
							
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="max-width: 310px; height: 160px;" data-trigger="fileinput">
									<img src="http://placehold.it/320x160" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 320px; max-height: 160px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="..." accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
							@if($errors->has('image'))
								<p class="text-danger">{{ $errors->first('image') }}</p>
							@endif
							
						</div>
					
					</div>
					
				</div>-->

				<div class="col-sm-4">
					
					<div class="panel panel-primary @if($errors->has('category_id')) panel-danger @endif" data-collapsed="0">
				
						<div class="panel-heading">
							<div class="panel-title">
								Category
							</div>
							
						</div>
						
						<div class="panel-body">
							
							<select name="category_id" class="selectboxit">
								@foreach($categories as $category)
									<option value="{{ $category->id }}" @if($category->id == $article->category->id) selected @endif>{{ $category->name }}</option>
								@endforeach
							</select>
							@if($errors->has('category_id'))
								<p class="text-danger">{{ $errors->first('category_id') }}</p>
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