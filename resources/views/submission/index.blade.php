@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-5">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>Skilt</th>
                    <th>Parkeringsfeil</th>
                    <th>Lokasjon</th>
                    <th>Parkert</th>
                    <th>Sendt inn</th>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                        <tr>
                            <td><a href="{{ route('parkering.show', $submission->uuid) }}">{{ $submission->licenseplate->registration }}</a></td>
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
            {{ $submissions->links() }}
        </div>
    </div>
</div>
@endsection