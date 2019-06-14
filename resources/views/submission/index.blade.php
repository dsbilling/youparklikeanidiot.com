@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('parking.create') }}" class="btn btn-success mb-2"><i class="fas fa-plus"></i> {{ __('Opprett') }}</a>
            <table class="table table-striped table-bordered">
                <thead>
                    <th>UUID</th>
                    <th>Location</th>
                    <th>Parkert</th>
                    <th>Sendt inn</th>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                        <tr>
                            <td><a href="{{ route('parking.show', $submission->uuid) }}">{{ $submission->uuid }}</a></td>
                            <td>{{ $submission->latitude }}, {{ $submission->longitude }}</td>
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