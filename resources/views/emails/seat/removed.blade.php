@extends('emails.layouts.main')
@section('subject', 'Reservasjon fjernet!')
@section('content') 

Your reservation for the {{ $seatname }} seat has been removed, since you have not paid for it within 48 hours of reservation time.<br>

@stop