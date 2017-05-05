@extends('emails.layouts.main')
@section('subject', 'Activate Account')
@section('content') 

<p>Hello {{ $firstname }}! To activate your account, click on the following link:</p>
<p><a href="{{ $link }}">{{ $link }}</a></p>

@stop