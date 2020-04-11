@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3><span class="flag-icon flag-icon-{{ strtolower($licenseplate->country_code) }}"></span> {!! Countries::where('cca2', $licenseplate->country_code)->first()->name->common !!} &mdash; {{ $licenseplate->registration }}</h3>
            <hr>
            <table class="table table-striped table-bordered">
                <thead>
                    <th>{{ __('parking.licenseplate') }}</th>
                    <th>{{ __('parking.parkingerror') }}</th>
                    <th>{{ __('parking.location') }}</th>
                    <th>{{ __('parking.images') }}</th>
                    <th>{{ __('parking.parked_at') }}</th>
                    <th>{{ __('parking.created_at') }}</th>
                </thead>
                <tbody>
                    @foreach($licenseplate->submissions as $submission)
                        <tr>
                            <td><a href="{{ route('parking.show', $submission->uuid) }}">{{ $licenseplate->registration }}</a></td>
                            <td>
                                @foreach($submission->types as $type)
                                    <span class="pr-2"><i class="fas fa-check pr-1"></i>{{ $type['title'] }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $submission->latitude }}, {{ $submission->longitude }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($submission->parked_at)->diffForHumans() }}</td>
                            <td>{{ \Carbon\Carbon::parse($submission->created_at)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection