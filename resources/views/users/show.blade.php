@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-6 mx-auto">

            <div class="card profile-card-1">
                <img src="{{ asset('image/parking.jpg') }}" alt="{{ $user->name }}" class="background" />
                <img src="https://via.placeholder.com/130" alt="profile-image" class="profile"/>
                <div class="card-content">
                    <h2>
                        @if(!$user->anon)
                            {{ $user->name }}<small>{{ $user->username }}</small>
                        @elseif($user->anon)
                            {{ $user->uuid }}<small class="text-warning text-uppercase"><em>{{ trans('account.profile.hidden') }}</em></small>
                        @endif
                    </h2>
                    {{-- <div class="icon-block">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-google-plus"></i></a>
                    </div> --}}
                    @if(Auth::id() === $user->id)
                        <div class="mt-4">
                            <a href="{{ route('account.profile.change') }}" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i> {{ trans('account.profile.change.title') }}</a>
                            {{-- <a href="{{ route('account-change-images') }}" class="btn btn-secondary btn-sm"><i class="fas fa-images"></i> {{ trans('user.profile.editimages') }}</a> --}}
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-light p-4 d-flex justify-content-end text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <h5 class="font-weight-bold mb-0 d-block">{{ count($user->submissions) }}</h5><small class="text-muted">{{ __('user.submissions') }}</small>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection