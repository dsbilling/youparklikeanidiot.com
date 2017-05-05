@extends('layouts.base.main')
@section('title', 'Account Settings')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<h2>Account Settings</h2>
			<hr>

			<div class="row">
				<div class="col-lg-3">
					@include('layouts.base.account-sidebar')
				</div>
				<div class="col-lg-9">
					<form action="{{ route('account-settings-post') }}" method="post">
						
						<div class="form-group @if ($errors->has('showname')) has-error @endif">
							<label for="showname">Show Fullname</label>
							<select class="form-control" name="showname">
								<option value="1" {{ ($showname == '1') ? 'selected' : '' }}>Yes</option>
								<option value="0" {{ ($showname == '0') ? 'selected' : '' }}>No</option>
							</select>
							@if($errors->has('showemail'))
								<p class="text-danger">{{ $errors->first('showemail') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('showemail')) has-error @endif">
							<label for="showemail">Show Email</label>
							<select class="form-control" name="showemail">
								<option value="1" {{ ($showemail == '1') ? 'selected' : '' }}>Yes</option>
								<option value="0" {{ ($showemail == '0') ? 'selected' : '' }}>No</option>
							</select>
							@if($errors->has('showemail'))
								<p class="text-danger">{{ $errors->first('showemail') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('showonline')) has-error @endif">
							<label for="showonline">Show Online Status</label>
							<select class="form-control" name="showonline">
								<option value="1" {{ ($showonline == '1') ? 'selected' : '' }}>Yes</option>
								<option value="0" {{ ($showonline == '0') ? 'selected' : '' }}>No</option>
							</select>
							@if($errors->has('showonline'))
								<p class="text-danger">{{ $errors->first('showonline') }}</p>
							@endif
						</div>

						<div class="form-group @if ($errors->has('userdateformat')) has-error @endif">
							<label for="userdateformat">Date format</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
								<select class="form-control" name="userdateformat">
									<option value="">-- Please select --</option>
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

						<div class="form-group @if ($errors->has('usertimeformat')) has-error @endif">
							<label for="usertimeformat">Time format</label>
							<div class="input-group">
								<span class="input-group-addon"><span class="fa fa-clock-o"></span></span>
								<select class="form-control" name="usertimeformat">
									<option value="">-- Please select --</option>
									<option value="H:i" {{ ($usertimeformat == 'H:i') ? 'selected' : '' }}>{{ date('H:i', time()) }} (H:i)</option>
									<option value="g:i a" {{ ($usertimeformat == 'g:i a') ? 'selected' : '' }}>{{ date('g:i a', time()) }} (g:i a)</option>
								</select>
							</div>
							@if($errors->has('usertimeformat'))
								<p class="text-danger">{{ $errors->first('usertimeformat') }}</p>
							@endif
						</div>
						<br><hr>
						<p class="text-right"><button type="submit" class="btn btn-lg btn-labeled btn-success"><span class="btn-label"><i class="fa fa-save"></i></span>Save</button></p>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
					</form>
				</div>
			</div>
			
		</div>
	</div>
</div>

@stop