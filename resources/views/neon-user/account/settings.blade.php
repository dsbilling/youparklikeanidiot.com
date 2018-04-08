@extends('layouts.main')
@section('title', 'Account Settings')
@section('content')

<div class="container">
	<h2>Account Settings</h2>
	
	<ol class="breadcrumb 2" >
		<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
		<li><a href="{{ route('account') }}">Account</a></li>
		<li class="active"><strong>Settings</strong></li>
	</ol>

	<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="{{ route('account-settings-post') }}">

		<div class="row">
			<div class="col-md-6">
				
				<div class="panel panel-primary" data-collapsed="0">
				
					<div class="panel-heading">
						<div class="panel-title">
							Privacy
						</div>
						
					</div>
					
					<div class="panel-body">
						
						<div class="row">
							<label class="col-sm-5 control-label">Show Fullname</label>
							<div class="col-sm-5 form-group @if ($errors->has('showname')) has-error @endif">
								<select class="form-control" name="showname">
									<option value="1" {{ ($showname == '1') ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ ($showname == '0') ? 'selected' : '' }}>No</option>
								</select>
								@if($errors->has('showemail'))
									<p class="text-danger">{{ $errors->first('showemail') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Show Email</label>
							<div class="col-sm-5 form-group @if ($errors->has('showemail')) has-error @endif">
								<select class="form-control" name="showemail">
									<option value="1" {{ ($showemail == '1') ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ ($showemail == '0') ? 'selected' : '' }}>No</option>
								</select>
								@if($errors->has('showemail'))
									<p class="text-danger">{{ $errors->first('showemail') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Show Online Status</label>
							<div class="col-sm-5 form-group @if ($errors->has('showonline')) has-error @endif">
								<select class="form-control" name="showonline">
									<option value="1" {{ ($showonline == '1') ? 'selected' : '' }}>Yes</option>
									<option value="0" {{ ($showonline == '0') ? 'selected' : '' }}>No</option>
								</select>
								@if($errors->has('showonline'))
									<p class="text-danger">{{ $errors->first('showonline') }}</p>
								@endif
							</div>
						</div>
					
					</div>
					
				</div>
			
			</div>
			
			
			<div class="col-md-6">
				
				<div class="panel panel-primary" data-collapsed="0">
				
					<div class="panel-heading">
						<div class="panel-title">
							Date and Time
						</div>
					</div>
					
					<div class="panel-body">
		
						<div class="row">
							<label class="col-sm-5 control-label">Date format</label>
							
							<div class="col-sm-5">
							
								<div class="form-group @if ($errors->has('userdateformat')) has-error @endif">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
										<select class="form-control" name="userdateformat">
											<option value="d. M Y" {{ ($userdateformat == 'd. M Y') ? 'selected' : '' }}>{{ date('d. M Y', time()) }} (d. M Y)</option>
											<option value="d.m.y" {{ ($userdateformat == 'd.m.y') ? 'selected' : '' }}>{{ date('d.m.y', time()) }} (d.m.y)</option>
											<option value="F j, Y" {{ ($userdateformat == 'F j, Y') ? 'selected' : '' }}>{{ date('F j, Y', time()) }} (F j, Y)</option>
											<option value="M j, Y" {{ ($userdateformat == 'M j, Y') ? 'selected' : '' }}>{{ date('M j, Y', time()) }} (M j, Y)</option>
											<option value="n/j/y" {{ ($userdateformat == 'n/j/y') ? 'selected' : '' }}>{{ date('n/j/y', time()) }} (n/j/y)</option>
											<option value="Y/m/d" {{ ($userdateformat == 'Y/m/d') ? 'selected' : '' }}>{{ date('Y/m/d', time()) }} (Y/m/d)</option>
										</select>
									</div>
									@if($errors->has('userdateformat'))
										<p class="text-danger">{{ $errors->first('userdateformat') }}</p>
									@endif
								</div>

							</div>
						</div>
						<div class="row">
							<label class="col-sm-5 control-label">Time format</label>
							
							<div class="col-sm-5">
								<div class="form-group @if ($errors->has('usertimeformat')) has-error @endif">
									<div class="input-group">
										<span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
										<select class="form-control" name="usertimeformat">
											<option value="H:i" {{ ($usertimeformat == 'H:i') ? 'selected' : '' }}>{{ date('H:i', time()) }} (H:i)</option>
											<option value="g:i a" {{ ($usertimeformat == 'g:i a') ? 'selected' : '' }}>{{ date('g:i a', time()) }} (g:i a)</option>
										</select>
									</div>
									@if($errors->has('usertimeformat'))
										<p class="text-danger">{{ $errors->first('usertimeformat') }}</p>
									@endif
								</div>
								
							</div>
						</div>
						
					</div>
				
				</div>
			</div>
		</div>
											
		<div class="form-group default-padding">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Changes</button>
		</div>
					
	</form>
</div>
<br /><br /><br />
@stop