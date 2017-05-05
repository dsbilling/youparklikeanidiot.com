@extends('layouts.main')
@section('title') 404 @stop
   
@section('content')
<div class="page-error-404">

	<div class="error-symbol">
		<i class="fa fa-exclamation-triangle"></i>
	</div>
	
	<div class="error-text">
		<h2>404</h2>
		<p>Page not found!</p>
	</div>
	
	<div class="error-text">
		
		<a class="btn btn-info" href="{{ URL::previous() }}"><i class="fa fa-arrow-left"></i> Go back</a>
		
	</div>

	<br><br>
	
</div>
@stop