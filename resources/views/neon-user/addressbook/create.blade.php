@extends('layouts.main')
@section('title', 'Add Address')
@section('content')

<div class="container">
	<h2>Add Address</h2>
	
	<ol class="breadcrumb 2" >
		<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
		<li><a href="{{ route('account') }}">Dashboard</a></li>
		<li><a href="{{ route('account-addressbook') }}">Address Book</a></li>
		<li class="active"><strong>Add Address</strong></li>
	</ol>

	<form role="form" method="post" class="form-horizontal form-groups-bordered validate" action="{{ route('account-addressbook-store') }}">

		<div class="row">
			<div class="col-md-12">
				
				<div class="panel panel-info">
				
					<div class="panel-heading">
						<div class="panel-title">
							Google Automatic Address Lookup
						</div>
					</div>
					
					<div class="panel-body">

						<div class="row">
							<label class="col-sm-5 control-label">Address</label>
							<div class="col-sm-5 form-group">
								<div class="input-group">
									<span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
									<input class="form-control" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()">
								</div>
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
							Your Address
						</div>
					</div>
					
					<div class="panel-body">

						<div class="row">
							<label class="col-sm-5 control-label">Address</label>
							<div class="col-sm-5 form-group @if($errors->has('address1')) has-error @endif">
								<input class="form-control" type="text" name="address1" placeholder="Jernbanegata" value="{{ (old('address1')) ? old('address1') : '' }}" id="route">
								@if($errors->has('address1'))
									<p class="text-danger">{{ $errors->first('address1') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Address 2<br><small>This field is used for house numbers</small></label>
							<div class="col-sm-5 form-group @if($errors->has('address2')) has-error @endif">
								<input class="form-control" type="text" name="address2" value="{{ (old('address2')) ? old('address2') : '' }}" id="street_number">
								@if($errors->has('address2'))
									<p class="text-danger">{{ $errors->first('address2') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Postal Code</label>
							<div class="col-sm-5 form-group @if($errors->has('postalcode')) has-error @endif">
								<input class="form-control" type="text" name="postalcode" placeholder="2609" value="{{ (old('postalcode')) ? old('postalcode') : '' }}" id="postal_code">
								@if($errors->has('postalcode'))
									<p class="text-danger">{{ $errors->first('postalcode') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">City</label>
							<div class="col-sm-5 form-group @if($errors->has('city')) has-error @endif">
								<input class="form-control" type="text" name="city" placeholder="Lillehammer" value="{{ (old('city')) ? old('city') : '' }}" id="locality">
								@if($errors->has('city'))
									<p class="text-danger">{{ $errors->first('city') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">County</label>
							<div class="col-sm-5 form-group @if($errors->has('county')) has-error @endif">
								<input class="form-control" type="text" name="county" placeholder="Oppland" value="{{ (old('county')) ? old('county') : '' }}" id="administrative_area_level_1">
								@if($errors->has('county'))
									<p class="text-danger">{{ $errors->first('county') }}</p>
								@endif
							</div>
						</div>

						<div class="row">
							<label class="col-sm-5 control-label">Country</label>
							<div class="col-sm-5 form-group @if($errors->has('country')) has-error @endif">
								<input class="form-control" type="text" name="country" placeholder="Norway" value="{{ (old('country')) ? old('country') : '' }}" id="country">
								@if($errors->has('country'))
									<p class="text-danger">{{ $errors->first('country') }}</p>
								@endif
							</div>
						</div>

						<hr>

						<div class="row">
							<label class="col-sm-5 control-label">Primary Address?</label>
							<div class="col-sm-5 checkbox @if($errors->has('primary')) has-error @endif">
								<label><input type="checkbox" name="primary" @if(old('primary')) checked @endif>Yes</label>
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
			<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add to Address Book</button>
		</div>
					
	</form>
</div>
@stop

@section('javascript')
	
	<script type="text/javascript">

	</script>
	
    <script>
    	
		// This example displays an address form, using the autocomplete feature
		// of the Google Places API to help users fill in the information.

		var placeSearch, autocomplete;
		var componentForm = {
		  street_number: 'short_name',
		  route: 'long_name',
		  locality: 'long_name',
		  administrative_area_level_1: 'short_name',
		  country: 'long_name',
		  postal_code: 'short_name'
		};

		function initAutocomplete() {
		  // Create the autocomplete object, restricting the search to geographical
		  // location types.
		  autocomplete = new google.maps.places.Autocomplete(
		      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
		      {types: ['geocode']});

		  // When the user selects an address from the dropdown, populate the address
		  // fields in the form.
		  autocomplete.addListener('place_changed', fillInAddress);
		}

		// [START region_fillform]
		function fillInAddress() {
		  // Get the place details from the autocomplete object.
		  var place = autocomplete.getPlace();

		  for (var component in componentForm) {
		    document.getElementById(component).value = '';
		    document.getElementById(component).disabled = false;
		  }

		  // Get each component of the address from the place details
		  // and fill the corresponding field on the form.
		  for (var i = 0; i < place.address_components.length; i++) {
		    var addressType = place.address_components[i].types[0];
		    if (componentForm[addressType]) {
		      var val = place.address_components[i][componentForm[addressType]];
		      document.getElementById(addressType).value = val;
		    }
		  }
		}
		// [END region_fillform]

		// [START region_geolocation]
		// Bias the autocomplete object to the user's geographical location,
		// as supplied by the browser's 'navigator.geolocation' object.
		function geolocate() {
		  if (navigator.geolocation) {
		    navigator.geolocation.getCurrentPosition(function(position) {
		      var geolocation = {
		        lat: position.coords.latitude,
		        lng: position.coords.longitude
		      };
		      var circle = new google.maps.Circle({
		        center: geolocation,
		        radius: position.coords.accuracy
		      });
		      autocomplete.setBounds(circle.getBounds());
		    });
		  }
		}
		// [END region_geolocation]


		(function($) {
			$(document).ready( function() { 
				// Block the enter key, because bug thats why
				$('html').bind('keypress', function(e)
				{
					if(e.keyCode == 13)
					{
						return false;
						geolocate();
					}
				});
			});
		})(jQuery);
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ Setting::get('GOOGLE_MAPS_API_KEY') }}&signed_in=true&libraries=places&callback=initAutocomplete" async defer></script>

@stop