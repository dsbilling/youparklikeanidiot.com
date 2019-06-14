@extends('layouts.app')

@section('css')
    <style type="text/css">
        #map { width:100%; min-height: 325px }
        .coordinates {
            background: rgba(0,0,0,0.5);
            color: #fff;
            position: absolute;
            bottom: 40px;
            left: 10px;
            padding:5px 10px;
            margin: 0;
            font-size: 11px;
            line-height: 18px;
            border-radius: 3px;
            display: none;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('parking.store') }}">
                <div class="form-group row">
                    <label for="licenseplate" class="col-md-4 col-form-label text-md-right">{{ __('License Plate') }}</label>
                    <div class="col-md-6">
                        <input id="licenseplate" type="text" class="form-control{{ $errors->has('licenseplate') ? ' is-invalid' : '' }}" name="licenseplate" value="{{ old('licenseplate') }}">
                        @if ($errors->has('licenseplate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('licenseplate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                    <div class="col-md-6">
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Velg lokasjon') }}</label>
                    <div class="col-md-6">
                        <div id="map"></div>
                        <pre id="coordinates" class="coordinates"></pre>
                        @if ($errors->has('location'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Last opp bilde') }}</label>
                    <div class="col-md-6">
                        <p>* insert image stuff *</p>
                        @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <button class="btn btn-success btn-block col-md-3">{{ _('Lagre') }}</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    mapboxgl.accessToken = '{{ env('MAPBOX_ACCESS_TOKEN') }}';
    var map = new mapboxgl.Map({
        container: 'map', // container id
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [0.0, 0.0], // starting position
        zoom: 3 // starting zoom
    });

    var marker = new mapboxgl.Marker({
        draggable: true
    })
    .setLngLat([0, 0])
    .addTo(map);
     
    function onDragEnd() {
        var lngLat = marker.getLngLat();
        coordinates.style.display = 'block';
        coordinates.innerHTML = 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
    }
     
    marker.on('dragend', onDragEnd);
     
    // Add geolocate control to the map.
    map.addControl(new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true
    }));
</script>
@endsection