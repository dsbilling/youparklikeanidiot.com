@extends('layouts.main')
@section('title', 'Edit Row - #'.$row->id.' - Admin')
@section('css')
	<style>
		.ms-container .ms-list {
			width: 135px;
			height: 205px;
		}
		
		.post-save-changes {
			float: right;
		}
		
		@media screen and (max-width: 789px)
		{
			.post-save-changes {
				float: none;
				margin-bottom: 20px;
			}
		}
	</style>
@stop
@section('content')

<div class="row">
	<div class="col-md-12">

		<h1 class="margin-bottom">Edit Row: <small>#{{ $row->id }}</small></h1>
		<ol class="breadcrumb 2">
			<li><a href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a></li>
			<li><a href="{{ route('admin') }}">Admin</a></li>
			<li>Seating</li>
			<li><a href="{{ route('admin-seating-rows') }}">Rows</a></li>
			<li class="active"><strong>Edit Row #{{ $row->id }}</strong></li>
		</ol>
					
		<br />
		
		<form action="{{ route('admin-seating-row-update', $row->id) }}" method="post">

			<!-- Title and Publish Buttons -->
			<div class="row">
				<div class="col-sm-2 post-save-changes">
					<button type="submit" class="btn btn-green btn-lg btn-block btn-icon">
						Save Changes
						<i class="fa fa-floppy-o"></i>
					</button>
				</div>

				<div class="col-sm-10">
					<div class="panel panel-primary @if($errors->has('name')) panel-danger @endif" data-collapsed="0">
						<div class="panel-heading">
							<div class="panel-title">Name</div>
						</div>
						<div class="panel-body">
							<input type="text" class="form-control input-lg" name="name" placeholder="A" value="{{ $row->name }}" />
							@if($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif
						</div>
					</div>
				</div>
				
			</div>

			<input type="hidden" name="_token" value="{{ csrf_token() }}">

		</form>

	</div>
</div>

@stop