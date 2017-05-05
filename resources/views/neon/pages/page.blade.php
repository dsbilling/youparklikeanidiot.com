@extends('layouts.main')
@section('title', $title)

@section('content')

<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>{{ $title }}</h1>
				<ol class="breadcrumb bc-3">
					<li class="active"><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
					<li>{{ $title }}</li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{!! $content !!}
			</div>
		</div>
	</div>	
</section>

@endsection
