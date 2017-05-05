@extends('layouts.base.main')
@section('title', 'Change Images')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2>Change Images</h2>
			<hr>
			<div class="row">
				<div class="col-lg-3">
					@include('layouts.base.account-sidebar')
				</div>
				<div class="col-lg-9">

					<div role="tabpanel">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#profileimage" aria-controls="profileimage" role="tab" data-toggle="tab">Profile Image</a></li>
							<li role="presentation"><a href="#coverimage" aria-controls="coverimage" role="tab" data-toggle="tab">Cover Image</a></li>
						</ul>
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="profileimage">
								<form action="{{ route('account-change-image-profile-post') }}" method="post" enctype="multipart/form-data">
									<div class="form-group @if ($errors->has('profileimage')) has-error @endif">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 250px; height: 250px;">
												<img src="{{ $profilepicture or 'http://placehold.it/250x250' }}" data-src="http://placehold.it/250x250" alt="250x250">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="height:auto; width:auto; max-width: 250px; max-height: 250px;"></div>
											<div>
												<span class="btn-file">
													<span class="btn btn-primary btn-labeled fileinput-new"><span class="btn-label"><i class="fa fa-picture-o"></i></span>Select image</span>
													<span class="btn btn-warning btn-labeled fileinput-exists"><span class="btn-label"><i class="fa fa-picture-o"></i></span>Change</span>
													<input type="file" name="profileimage">
												</span>
												<a href="#" class="btn btn-labeled btn-danger fileinput-exists" style="margin-top:12px;" data-dismiss="fileinput"><span class="btn-label"><i class="fa fa-remove"></i></span>Remove</a>
											</div>
										</div>
										@if($errors->has('profileimage'))
											<p class="text-danger">{{ $errors->first('profileimage') }}</p>
										@endif
									</div>
									<hr>
									<p class="text-right"><button type="submit" class="btn btn-lg btn-labeled btn-success"><span class="btn-label"><i class="fa fa-upload"></i></span>Upload</button></p>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
							</div>
							<div role="tabpanel" class="tab-pane" id="coverimage">
								<form action="{{ route('account-change-image-cover-post') }}" method="post" enctype="multipart/form-data">
									<div class="form-group @if($errors->has('profilecover')) has-error @endif">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="max-width: 500px; max-height: 160px;">
												<img src="{{ $profilecover or 'http://placehold.it/1500x480' }}" data-src="http://placehold.it/1500x480" alt="1500x480">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="height:auto; width:auto; max-width: 250px; max-height: 250px;"></div>
											<div>
												<span class="btn-file">
													<span class="btn btn-primary btn-labeled fileinput-new"><span class="btn-label"><i class="fa fa-picture-o"></i></span>Select image</span>
													<span class="btn btn-warning btn-labeled fileinput-exists"><span class="btn-label"><i class="fa fa-picture-o"></i></span>Change</span>
													<input type="file" name="profilecover">
												</span>
												<a href="#" class="btn btn-labeled btn-danger fileinput-exists" style="margin-top:12px;" data-dismiss="fileinput"><span class="btn-label"><i class="fa fa-remove"></i></span>Remove</a>
											</div>
										</div>
										@if($errors->has('profilecover'))
											<p class="text-danger">{{ $errors->first('profilecover') }}</p>
										@endif
									</div>
									<hr>
									<p class="text-right"><button type="submit" class="btn btn-lg btn-labeled btn-success"><span class="btn-label"><i class="fa fa-upload"></i></span>Upload</button></p>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</form>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
@stop