@extends('emails.layout.main')
@section('subject') Forgot Password @stop
@section('content') 

It looks as if you have requested a new password. Use password below to create a new one.
If you do not expect this mail, you can safely ignore it.<br><br>

New password: {{ $password }}<br><br>
<a href="{{ $link }}">{{ $link }}</a><br>

@stop