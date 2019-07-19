@extends('layouts.app')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
        	<p class="display-4">{{ $title }}</p>
        	<hr>
        	{!! $content !!}
        </div>
    </div>
</div>
@endsection