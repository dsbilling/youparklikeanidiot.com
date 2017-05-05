@extends('layouts.errors')
@section('title', 'Unknown Error')
   
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 text-center">
			<h1 class="error-header">{{ $code }}</h1>
			<h3 class="error-lead text-muted">Unexpected code malfunction was encountered.</h3>
		</div>
	</div>
</div> 
@stop