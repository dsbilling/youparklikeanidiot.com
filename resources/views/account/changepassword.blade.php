@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-5">
        <div class="col-12 col-lg-6 mx-auto">

			<form class="card" role="form" method="post" action="{{ route('account.password.change.store') }}">
				<h5 class="card-header">{{ trans('account.password.change.title') }}</h5>
				<div class="card-body">
					<div class="form-group">
						<label class="form-label">{{ trans('global.current') }} {{ trans('global.password') }}</label>
						<div class="input-group">
							<input class="form-control @error('current_password') is-invalid @enderror" type="password" name="current_password">
						</div>
						@error('current_password')
							<div class="invalid-feedback">{{ $errors->first('current_password') }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('global.new') }} {{ trans('global.password') }}</label>
						<div class="input-group">
							<input class="form-control @error('password') is-invalid @enderror" type="password" name="password">
						</div>
						@error('password')
							<div class="invalid-feedback">{{ $errors->first('password') }}</div>
						@enderror
					</div>
					<div class="form-group">
						<label class="form-label">{{ trans('global.confirm') }} {{ trans('global.new') }} {{ trans('global.password') }}</label>
						<div class="input-group">
							<input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation">
						</div>
						@error('password_confirmation')
							<div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
						@enderror
					</div>
				</div>
				<div class="card-footer text-right">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-success"><i class="fas fa-save"></i> {{ trans('global.savechanges') }}</button>
				</div>
			</form>

        </div>
    </div>
</div>
@endsection