@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-5">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>{{ __('parking.country') }}</th>
                    <th>{{ __('parking.licenseplate') }}</th>
                    <th>{{ __('parking.parkingerror') }}</th>
                    <th>{{ __('parking.location') }}</th>
                    <th>{{ __('parking.images') }}</th>
                    <th>{{ __('parking.parked_at') }}</th>
                    <th>{{ __('parking.created_at') }}</th>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                        <tr>
                            <td><span class="flag-icon flag-icon-{{ strtolower($submission->licenseplate->country_code) }}"></span> {!! Countries::where('cca2', $submission->licenseplate->country_code)->first()->name->common !!}</td>
                            <td><a href="{{ route('parking.show', $submission->uuid) }}">{{ $submission->licenseplate->registration }}</a></td>
                            <td>
                                @foreach($submission->types as $type)
                                    <span class="pr-2"><i class="fas fa-check pr-1"></i>{{ $type['title'] }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $submission->latitude }}, {{ $submission->longitude }}
                            </td>
                            <td>{{ $submission->images->count() }}</td>
                            <td>{{ \Carbon\Carbon::parse($submission->parked_at)->diffForHumans() }}</td>
                            <td>{{ \Carbon\Carbon::parse($submission->created_at)->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $submissions->links() }}
        </div>
    </div>
</div>
@endsection