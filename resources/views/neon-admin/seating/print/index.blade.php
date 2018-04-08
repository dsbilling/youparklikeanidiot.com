@extends('layouts.main')
@section('title', 'Print - Admin')
@section('css')
	<link rel="stylesheet" href="{{ Theme::url('css/seating.css') }}">
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Print</h1>

		<ol class="breadcrumb">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li class="active"><strong>Print</strong></li>
		</ol>

		@include('seating.print.seatmap')

	</div>
</div>

@stop