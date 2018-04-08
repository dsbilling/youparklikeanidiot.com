@extends('layouts.main')
@section('title', '500')

@section('content')
<div class="page-error-404">

    <div class="error-symbol">
        <i class="fa fa-exclamation-triangle"></i>
    </div>
    
    <div class="error-text">
        <h2>500</h2>
        <h3>Looks like we're having some server issues.</h3>
        <h4>We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try refreshing.</h4>
    </div>
    
    <div class="error-text">
        
        <a class="btn btn-info" href="{{ URL::previous() }}"><i class="fa fa-arrow-left"></i> Go back</a>
        
    </div>

    <br><br>
    
</div>

@if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
    <div class="subtitle">Error ID: {{ Sentry::getLastEventID() }}</div>
    <!-- Sentry JS SDK 2.1.+ required -->
    <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>
    <script>
        Raven.showReportDialog({
            eventId: '{{ Sentry::getLastEventID() }}',
            // use the public DSN (dont include your secret!)
            dsn: 'https://e9ebbd88548a441288393c457ec90441@sentry.io/3235'
        });
    </script>
@endif
@stop