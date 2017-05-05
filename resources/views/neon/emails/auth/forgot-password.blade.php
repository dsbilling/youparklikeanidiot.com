@extends('layouts.emails.main')
@section('subject', 'Forgot Password')
@section('content') 

It looks as if you have requested to reset your password. Use the link below to create a new password for your account.
If you did not expect this email, you can safely ignore it.<br><br>

Reset Password URL: <a href="{{ $link }}">{{ $link }}</a><br>
<small>{{ $link }}</small><br><br>


If you have any questions at all, feel free to contact us!<br>

@stop