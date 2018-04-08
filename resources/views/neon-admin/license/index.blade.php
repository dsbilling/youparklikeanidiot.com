@extends('layouts.main')
@section('title', 'License Status - Admin')
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">License Status</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li class="active"><strong>License Status</strong></li>
		</ol>

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-primary @if(Setting::get('APP_LICENSE_STATUS') == 'Active') panel-success @else panel-danger @endif" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">Status</div>
					</div>
					<div class="panel-body">
						<p>Status: @if(Setting::get('APP_LICENSE_STATUS') == 'Active') <strong class="text-success">{{ Setting::get('APP_LICENSE_STATUS') }}</strong> @else <strong class="text-danger">{{ Setting::get('APP_LICENSE_STATUS') }}</strong> @endif</p>
						<p>@if(Setting::get('APP_LICENSE_STATUS_DESC') != "")Description: <em>{{ Setting::get('APP_LICENSE_STATUS_DESC') }}</em>@endif</p>
						<a href="{{ route('admin-license-check') }}" class="btn btn-success btn-icon icon-left"><i class="fa fa-refresh"></i> Check License Status</a>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-primary @if($errors->has('APP_LICENSE_KEY')) panel-danger @endif" data-collapsed="0">
					<div class="panel-heading">
						<div class="panel-title">Update License Key</div>
					</div>
					<div class="panel-body">
						<form action="{{ route('admin-license-store') }}" method="post">
							<div class="input-group">
								<input type="text" class="form-control input-lg" name="licensekey" placeholder="LANMS-XXX-XXXXXXXXXXXXXX" value="{{ (old('licensekey')) ? old('licensekey') : Setting::get('APP_LICENSE_KEY') }}" />
								<span class="input-group-btn"><button type="submit" class="btn btn-lg btn-success btn-icon icon-left"><i class="fa fa-floppy-o"></i> Save</button></span>
							</div>
							@if($errors->has('licensekey'))
								<p class="text-danger">{{ $errors->first('licensekey') }}</p>
							@endif
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
@stop