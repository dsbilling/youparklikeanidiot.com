@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('parking.store') }}" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="licenseplate" class="col-4 col-form-label text-md-right">{{ __('Skilt') }}</label>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" id="country" class="form-control">
                                <input type="hidden" id="country_code" name="licenseplate_country" value="{{ old('licenseplate_country') }}">
                            </div>
                            <div class="col-6">
                                <input id="licenseplate" type="text" class="form-control{{ $errors->has('licenseplate') ? ' is-invalid' : '' }}" name="licenseplate" value="{{ old('licenseplate') }}" autofocus placeholder="AA12345">
                            </div>
                        </div>
                        @if ($errors->has('licenseplate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('licenseplate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date" class="col-4 col-form-label text-md-right">{{ __('Tid ved parkering') }}</label>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6">
                                <input id="date" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}"  max="{{ Carbon\Carbon::now()->toDateString() }}">
                            </div>
                            <div class="col-6">
                                <input type="time" class="form-control{{ $errors->has('time') ? ' is-invalid' : '' }}" name="time" value="{{ old('time') }}">
                            </div>
                        </div>
                        @if ($errors->has('date'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('date') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('time'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('time') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="location" class="col-4 col-form-label text-md-right">{{ __('Velg lokasjon') }}</label>
                    <div class="col-6">
                        <div id="map" class="{{ $errors->has('longitude') ? ' is-invalid' : '' }} {{ $errors->has('latitude') ? ' is-invalid' : '' }}"></div>
                        <pre id="coordinates" class="coordinates"></pre>
                        <input type="text" name="longitude" hidden value="{{ old('longitude') }}">
                        <input type="text" name="latitude" hidden value="{{ old('latitude') }}">
                        @if ($errors->has('longitude'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('longitude') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('latitude'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('latitude') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="images" class="col-4 col-form-label text-md-right">{{ __('Last opp bilde') }}</label>
                    <div class="col-6">

                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="images[]" accept=".png, .jpg, .jpeg" multiple lang="{{ app()->getLocale() }}">
                                <label class="custom-file-label" for="customFile">{{ __('Velg fil') }}</label>
                            </div>
                        </div>

                        @if ($errors->has('images'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('images') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="types" class="col-4 col-form-label text-md-right">{{ __('Velg parkerings feil') }}</label>
                    <div class="col-6">
                        @foreach(\DPSEI\Type::orderBy('title', 'asc')->get() as $type)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="types[]" value="{{ $type->id }}" @if(is_array(old('types')) && in_array($type->id, old('types'))) checked @endif>
                                <label class="custom-control-label">{{ $type->title }}</label>
                            </div>
                        @endforeach
                        @if ($errors->has('types'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('types') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-4 col-form-label text-md-right">{{ __('Kommentar') }}<br><small class="text-muted">{{ __('Valgfritt') }}</small></label>
                    <div class="col-6">
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <div class="col-2 ml-auto">
                        {{ csrf_field() }}
                        <button class="btn btn-success btn-block"><i class="fas fa-paper-plane"></i> {{ _('Send inn') }}</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link href="{{ asset('css/countrySelect.css') }}" rel="stylesheet" />

    <style type="text/css">
        #map { width:100%; min-height: 325px }
        #map.is-invalid { border: #e3342f 2px solid; }
        .coordinates {
            background: rgba(0,0,0,0.5);
            color: #fff;
            position: absolute;
            bottom: 40px;
            left: 20px;
            padding:5px 10px;
            margin: 0;
            font-size: 11px;
            line-height: 18px;
            border-radius: 3px;
            display: none;
        }
    </style>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.css' type='text/css' />
@endsection

@section('javascript')
    <script src="{{ asset('js/countrySelect.js') }}"></script>
    <script>
        $("#country").countrySelect();
        @if(old('licenseplate_country'))
            $("#country").countrySelect("selectCountry", "{{ old('licenseplate_country') }}");
        @endif
    </script> 

    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.3.0/mapbox-gl-geocoder.min.js'></script>
    <script>
        mapboxgl.accessToken = '{{ env('MAPBOX_ACCESS_TOKEN') }}';
        var map = new mapboxgl.Map({
            container: 'map', // container id
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [{{ old('longitude') ?? 10.40 }}, {{ old('latitude') ?? 59.61 }}], // starting position
            zoom: 3 // starting zoom
        });

        var marker = new mapboxgl.Marker({
            draggable: true
        })
        .setLngLat([{{ old('longitude') ?? 10.40 }}, {{ old('latitude') ?? 59.61 }}])
        .addTo(map);

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            coordinates.style.display = 'block';
            coordinates.innerHTML = 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
            $('input[name=longitude]').val(lngLat.lng);
            $('input[name=latitude]').val(lngLat.lat);
        }

        @if(old('longitude') && old('latitude'))
            onDragEnd();
        @endif
         
        marker.on('dragend', onDragEnd);

        // Add zoom and rotation controls to the map.
        map.addControl(new mapboxgl.NavigationControl());
         
        // Add geolocate control to the map.
        map.addControl(new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: false
            },
            trackUserLocation: true
        }));

        var geocoder = new MapboxGeocoder({ // Initialize the geocoder
            accessToken: mapboxgl.accessToken, // Set the access token
            mapboxgl: mapboxgl, // Set the mapbox-gl instance
            marker: false, // Do not use the default marker style
        });
        map.addControl(geocoder, 'top-left');

        geocoder.on('result', function(e) {
            var coord = e.result.center;
            marker.setLngLat([coord[0], coord[1]]);
            onDragEnd();
        });

    </script>
    <script type="text/javascript">
        $('.custom-file-input').on('change', function() { 
            var fileList = document.getElementById("customFile").files;
            if(fileList.length > 1) {
                $(this).next('.custom-file-label').addClass("selected").html(fileList.length+" filer");
            } else {
                let fileName = $(this).val().split('\\').pop(); 
                $(this).next('.custom-file-label').addClass("selected").html(fileName); 
            }
        });
    </script>
@endsection