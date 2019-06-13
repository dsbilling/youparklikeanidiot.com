@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>UUID</th>
                    <th>Location</th>
                    <th>Parkert</th>
                    <th>Sendt inn</th>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                        <td><a href="{{ route('parking.show', $submission->uuid) }}">{{ $submission->uuid }}</a></td>
                        <td>{{ $submission->latitude }}, {{ $submission->longitude }}</td>
                        <td>{{ \Carbon\Carbon::parse($submission->parked_at)->diffForHumans() }}</td>
                        <td>{{ \Carbon\Carbon::parse($submission->created_at)->diffForHumans() }}</td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection