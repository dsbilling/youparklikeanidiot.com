@extends('layouts.app')
@section('css')
<style type="text/css">
    .profile-header {
        transform: translateY(5rem);
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-xl-6 col-md-6 col-sm-10 mx-auto">

            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 bg-dark">
                    <div class="media align-items-end profile-header">
                        <div class="profile mr-3"><img src="https://via.placeholder.com/130" alt="{{ $name }}" width="130" class="rounded mb-2 img-thumbnail">@if(Auth::id() === $id)<a href="#" class="btn btn-dark btn-sm btn-block">{{ __('Edit profile') }}</a>@endif</div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-0">{{ $name }}</h4>
                            <p class="small mb-4">{{--<i class="fa fa-map-marker mr-2"></i>Oslo, Norway--}}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-light p-4 d-flex justify-content-end text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">0</h5><small class="text-muted">{{ __('Submissions') }}</small>
                        </li>
                    </ul>
                </div>
                {{--
                <div class="py-4 px-4">
                    <div class="py-4">
                        <h5 class="mb-3">{{ __('Recent submissions') }}</h5>
                        <div class="p-4 bg-light rounded shadow-sm">
                            <p class="font-italic mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                            <ul class="list-inline small text-muted mt-3 mb-0">
                                <li class="list-inline-item"><i class="fa fa-comment-o mr-2"></i>12 Comments</li>
                                <li class="list-inline-item"><i class="fa fa-heart-o mr-2"></i>200 Likes</li>
                            </ul>
                        </div>
                    </div>
                </div>--}}
            </div>

        </div>
    </div>
</div>
@endsection