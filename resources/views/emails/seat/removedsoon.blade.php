@extends('emails.layouts.main')
@section('subject', 'Din reservasjon vil bli fjernet snart')
@section('content') 

Your reservation for the {{ $seatname }} seat will be removed in 24 hours, if you do not pay for the seat.<br>

@stop