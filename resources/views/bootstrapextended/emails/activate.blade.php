@extends('emails.layout.main')
@section('subject') Activate Account @stop
@section('content') 

To activate your account, click on the following link:<br>
<a href="{{ $link }}">{{ $link }}</a><br>

@stop