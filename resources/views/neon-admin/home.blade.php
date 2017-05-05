@extends('layouts.main')
@section('title', 'Admin Dashboard')
   
@section('content')
<div class="row">
	<div class="col-md-12">
		<h1 class="margin-bottom">Admin Dashboard</small></h1>
		<ol class="breadcrumb 2" >
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li class="active"><strong>Admin Dashboard</strong></li>
		</ol>
					
		<br />

		<p>Admin Dashboard!</p>
	</div>
</div>
@stop