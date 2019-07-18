@extends('layouts.app')

@section('css')
    <style type="text/css">
        #map { width:100%; min-height: 325px }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row text-center text-lg-left">
                @foreach($images as $image)
                    <div class="col-lg-4 col-md-4 col-6 mb-4">
                        <a href="{{ asset($image['path']) }}"  data-toggle="lightbox" data-gallery="example-gallery" class="d-block h-100"><img class="img-fluid img-thumbnail" src="{{ asset($image['path']) }}" alt=""></a>
                    </div>
                @endforeach
            </div>
            <div class="mt-3 mb-3" id="map"></div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">{{ __('Parkerings feil') }}</div>
                <div class="card-body">
                    @foreach($types as $type)
                        <span><i class="fas fa-check pr-1"></i>{{ $type['title'] }}</span><br>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Info') }}</div>
                <div class="card-body">
                    <p>{{ __('Regnr:') }} {{ $licenseplate['registration'] }}</p>
                    @if($description)<p>{{ __('Kommentar:') }}<br>{{ $description }}</p>@endif
                    <p>{{ __('Parkering skjedde:') }} {{ \Carbon\Carbon::parse($parked_at)->diffForHumans()  }}</p>
                    <p class="mb-0">{{ __('Send inn av:') }} <a href="{{ route('user.show', $user['username']) }}">{{ $user['username'] }}</a> {{ __('for') }} {{ \Carbon\Carbon::parse($created_at)->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function ($) {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
        });
    </script>
    <script>
        mapboxgl.accessToken = "{{ env('MAPBOX_ACCESS_TOKEN') }}";
         
        /* Map: This represents the map on the page. */
        var map = new mapboxgl.Map({
            container: "map",
            style: "mapbox://styles/mapbox/satellite-streets-v11",
            zoom: 15,
            center: [{{ $longitude }}, {{ $latitude }}]
        });

        // Add zoom and rotation controls to the map.
        map.addControl(new mapboxgl.NavigationControl());

        map.on("load", function () {
          /* Image: An image is loaded and added to the map. */
          map.loadImage("{{ asset('image/map-marker.png') }}", function(error, image) {
              if (error) throw error;
              map.addImage("custom-marker", image);
              /* Style layer: A style layer ties together the source and image and specifies how they are displayed on the map. */
              map.addLayer({
                id: "markers",
                type: "symbol",
                /* Source: A data source specifies the geographic coordinate where the image marker gets placed. */
                source: {
                  type: "geojson",
                  data: {
                    type: 'FeatureCollection',
                    features: [
                      {
                        type: 'Feature',
                        properties: {},
                        geometry: {
                          type: "Point",
                          coordinates: [{{ $longitude }}, {{ $latitude }}]
                        }
                      }
                    ]
                  }
                },
                layout: {
                  "icon-image": "custom-marker",
                  "icon-size": 0.1,
                }
              });
            });
        });
    </script>
@endsection
