@extends('layouts.main')
@section('title', $title)

@section('content')

<div class="container">
  <div class="row">
    <div class="col s12">
      <h1 class="post-title">{{ $title }}</h1>

      {!! $content !!}
    </div>
  </div>
</div>

@endsection
