@extends('layouts.main')
@section('title', 'Change Images')

@section('content')
<div class="container">
	<h2>Account Settings</h2>
	
	<ol class="breadcrumb 2" >
		<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="{{ route('account') }}">Dashboard</a></li>
		<li class="active"><strong>Change Images</strong></li>
	</ol>

	<div class="form-horizontal form-groups-bordered validate">

		<div class="row">
			<div class="col-md-6">
				
				<div class="panel panel-primary" data-collapsed="0">
				
					<div class="panel-heading">
						<div class="panel-title">
							Profile Photo <small class="text-muted">115x115</small>
						</div>
						
					</div>
					
					<div class="panel-body">
						
						<div class="col-md-12">
							<form action="{{ route('account-change-image-profile-post') }}" method="post" enctype="multipart/form-data">
								<div class="form-group @if ($errors->has('profileimage')) has-error @endif">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 115px; height: 115px;" data-trigger="fileinput">
											<img src="{{ $profilepicture or 'https://placehold.it/115x115' }}" alt="115x115">
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="height:auto; width:auto; max-width: 115px; max-height: 115px;"></div>
										<div>
											<span class="btn-file">
												<span class="btn btn-primary btn-labeled fileinput-new"><span class="btn-label"><i class="fa fa-picture-o"></i></span> Select image</span>
												<span class="btn btn-warning btn-labeled fileinput-exists"><span class="btn-label"><i class="fa fa-picture-o"></i></span> Change</span>
												<input type="file" name="profileimage" accept="image/*">
											</span>
											<a href="#" class="btn btn-labeled btn-danger fileinput-exists" style="margin-top:12px;" data-dismiss="fileinput"><span class="btn-label"><i class="fa fa-remove"></i></span> Remove</a>
										</div>
									</div>
									@if($errors->has('profileimage'))
										<p class="text-danger">{{ $errors->first('profileimage') }}</p>
									@endif
								</div>
								<hr>
								<p class="text-right"><button type="submit" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-upload"></i></span> Upload</button></p>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</form>
						</div>
					
					</div>
					
				</div>
			
			</div>
			
			
			<div class="col-md-6">
				
				<div class="panel panel-primary" data-collapsed="0">
				
					<div class="panel-heading">
						<div class="panel-title">
							Cover Photo <small class="text-muted">1920x1080</small>
						</div>
					</div>
					
					<div class="panel-body">
					
						<div class="col-md-12">
							<form action="{{ route('account-change-image-cover-post') }}" method="post" enctype="multipart/form-data">
								<div class="form-group @if($errors->has('profilecover')) has-error @endif">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="max-width: 500px; max-height: 290px;">
											<img src="{{ $profilecover or 'https://placehold.it/1920x1080' }}" alt="1920x1080">
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="height:auto; width:auto; max-width: 250px; max-height: 250px;"></div>
										<div>
											<span class="btn-file">
												<span class="btn btn-primary btn-labeled fileinput-new"><span class="btn-label"><i class="fa fa-picture-o"></i></span> Select image</span>
												<span class="btn btn-warning btn-labeled fileinput-exists"><span class="btn-label"><i class="fa fa-picture-o"></i></span> Change</span>
												<input type="file" name="profilecover">
											</span>
											<a href="#" class="btn btn-labeled btn-danger fileinput-exists" style="margin-top:12px;" data-dismiss="fileinput"><span class="btn-label"><i class="fa fa-remove"></i></span> Remove</a>
										</div>
									</div>
									@if($errors->has('profilecover'))
										<p class="text-danger">{{ $errors->first('profilecover') }}</p>
									@endif
								</div>
								<hr>
								<p class="text-right"><button type="submit" class="btn btn-labeled btn-success"><span class="btn-label"><i class="fa fa-upload"></i></span> Upload</button></p>
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
							</form>
						</div>
					</div>
				
				</div>
			</div>
		</div>
					
	</div>
</div>

@stop

@section('javascript')
	<script src="{{ Theme::url('js/fileinput.js') }}"></script>
@stop