@extends('layouts.main')
@section('title', 'Edit Address')
@section('content')

<div class="container">
	<h2>Edit Address</h2>
	
	<ol class="breadcrumb 2" >
		<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="{{ route('account') }}">Dashboard</a></li>
		<li><a href="{{ route('account-addressbook') }}">Address Book</a></li>
		<li class="active"><strong>Edit Address</strong></li>
	</ol>

	<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="{{ route('account-addressbook-update', $id) }}">

		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-primary">
				
					<div class="panel-heading">
						<div class="panel-title">
							Your Address
						</div>
					</div>
					
					<div class="panel-body">

						<div class="row">
							<label class="col-sm-5 control-label">Address</label>
							<div class="col-sm-5 form-group @if($errors->has('address1')) has-error @endif">
								<input class="form-control" type="text" name="address1" placeholder="Jernbanegata 15" value="{{ $address1 }}">
								@if($errors->has('address1'))
									<p class="text-danger">{{ $errors->first('address1') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Address 2</label>
							<div class="col-sm-5 form-group @if($errors->has('address2')) has-error @endif">
								<input class="form-control" type="text" name="address2" value="{{ $address2 }}">
								@if($errors->has('address2'))
									<p class="text-danger">{{ $errors->first('address2') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Postal Code</label>
							<div class="col-sm-5 form-group @if($errors->has('postalcode')) has-error @endif">
								<input class="form-control" type="text" name="postalcode" placeholder="2609" value="{{ $postalcode }}">
								@if($errors->has('postalcode'))
									<p class="text-danger">{{ $errors->first('postalcode') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">City</label>
							<div class="col-sm-5 form-group @if($errors->has('city')) has-error @endif">
								<input class="form-control" type="text" name="city" placeholder="Lillehammer" value="{{ $city }}">
								@if($errors->has('city'))
									<p class="text-danger">{{ $errors->first('city') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">County</label>
							<div class="col-sm-5 form-group @if($errors->has('county')) has-error @endif">
								<input class="form-control" type="text" name="county" placeholder="Oppland" value="{{ $county }}">
								@if($errors->has('county'))
									<p class="text-danger">{{ $errors->first('county') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Country</label>
							<div class="col-sm-5 form-group @if($errors->has('country')) has-error @endif">
								<input class="form-control" type="text" name="country" placeholder="Norway" value="{{ $country }}">
								@if($errors->has('country'))
									<p class="text-danger">{{ $errors->first('country') }}</p>
								@endif
							</div>
						</div>

						<hr>

						<div class="row">
							<label class="col-sm-5 control-label">Primary Address?</label>
							<div class="col-sm-5 checkbox @if($errors->has('primary')) has-error @endif">
								<label><input type="checkbox" name="primary" @if($primary) selected @endif>Yes</label>
								@if($errors->has('primary'))
									<p class="text-danger">{{ $errors->first('primary') }}</p>
								@endif
							</div>
						</div>

					
					</div>
					
				</div>
			
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-primary">
				
					<div class="panel-heading">
						<div class="panel-title">
							Confirm your password
						</div>
					</div>
					
					<div class="panel-body">

						<div class="row">
							<label class="col-sm-5 control-label">Password</label>
							<div class="col-sm-5 form-group @if ($errors->has('password')) has-error @endif">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-asterisk"></span></span>
									<input class="form-control" type="password" name="password">
								</div>
								@if($errors->has('password'))
									<p class="text-danger">{{ $errors->first('password') }}</p>
								@endif
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