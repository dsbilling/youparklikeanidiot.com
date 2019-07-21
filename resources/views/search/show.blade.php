@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Søke resultater</h3>
            <p>{{ $searchResults->count() }} {{ $searchResults->count() == 1 ? 'resultat' : 'resultater' }}</p>
            <hr>
            @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                @foreach($modelSearchResults as $searchResult)
                    <h5><i class="fas fa-car-side mr-1"></i><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></h5>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection