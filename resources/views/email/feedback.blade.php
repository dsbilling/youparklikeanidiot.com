@component('mail::message')
# Feedback received!

<strong>From:</strong> {{ $data->name }} ({{ $data->email }})

<strong>Message:</strong><br>
{{ $data->message }}
@endcomponent