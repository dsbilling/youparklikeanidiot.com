@extends('layouts.main')
@section('title') Home @stop

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					@if(Auth::guest())
						You are not logged in.
					@else
						You are logged in!
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
