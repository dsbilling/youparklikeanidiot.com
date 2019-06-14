@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('parking.store') }}">
                <div class="form-group row">
                    <label for="licenseplate" class="col-md-4 col-form-label text-md-right">{{ __('License Plate') }}</label>
                    <div class="col-md-6">
                        <input id="licenseplate" type="text" class="form-control{{ $errors->has('licenseplate') ? ' is-invalid' : '' }}" name="licenseplate" value="{{ old('licenseplate') }}">
                        @if ($errors->has('licenseplate'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('licenseplate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                    <div class="col-md-6">
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Velg lokasjon') }}</label>
                    <div class="col-md-6">
                        <p>* insert map here *</p>
                        @if ($errors->has('location'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Last opp bilde') }}</label>
                    <div class="col-md-6">
                        <p>* insert image stuff *</p>
                        @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <button class="btn btn-success btn-block col-md-3">{{ _('Lagre') }}</button>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection