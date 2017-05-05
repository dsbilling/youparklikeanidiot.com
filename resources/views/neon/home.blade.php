@extends('layouts.main')
@section('title') Home @stop

@section('content')

<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>Home</h1>
				<ol class="breadcrumb bc-3">
					<li class="active"><a href="#"><i class="fa fa-home"></i> Home</a></li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Home</div>

					<div class="panel-body">
						<p>@if(Sentinel::guest())
								NOT LOGGED IN
							@else
								LOGGED IN
							@endif
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>	
</section>

@endsection
