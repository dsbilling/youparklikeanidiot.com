@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-6 mx-auto">

			<form class="card" role="form" method="post" action="{{ route('account.profile.change.store') }}">
				<h5 class="card-header">{{ trans('account.profile.change.title') }}</h5>
				<div class="card-body">
					
					<div class="form-group">
						<label class="form-label">{{ trans('global.name') }}</label>
						<div class="input-group">
							<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('remember') ? old('remember') : Auth::user()->name }}">
						</div>
						@error('name')
							<div class="invalid-feedback">{{ $errors->first('name') }}</div>
						@enderror
					</div>

					<div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="anon" id="anon" @if (old('anon') || Auth::user()->anon) {{'checked'}} @endif >
                            <label class="form-check-label" for="anon">
                                {!! __('account.profile.change.anon') !!}
                            </label>
                        </div>
                    </div>

					<hr>

					<div class="form-group">
						<label class="form-label">{{ trans('account.profile.change.confirmpassword') }}</label>
						<div class="input-group">
							<input class="form-control @error('password') is-invalid @enderror" type="password" name="password">
						</div>
						@error('password')
							<div class="invalid-feedback">{{ $errors->first('password') }}</div>
						@enderror
					</div>
				</div>
				<div class="card-footer text-right">
					@csrf
					<button type="submit" class="btn btn-success"><i class="fas fa-save"></i> {{ trans('global.savechanges') }}</button>
				</div>
			</form>

        </div>
    </div>
</div>
@endsection