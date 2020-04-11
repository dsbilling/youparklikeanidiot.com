@extends('layouts.app')

@section('content')
<div class="page-wrap d-flex flex-row align-items-center mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">{{ __('error.404.title') }}</span>
                <div class="mb-4 lead">{{ __('error.404.lead') }}</div>
                <a href="{{ url('/') }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i> {{ __('error.backbutton') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection