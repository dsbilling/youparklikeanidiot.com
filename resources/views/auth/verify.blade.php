@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bekreft e-postadressen din') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('En ny bekreftelseslink er sendt til din e-postadresse.') }}
                        </div>
                    @endif

                    {{ __('Før du fortsetter, vennligst sjekk e-posten din for en bekreftelseslink.') }}
                    {{ __('Hvis du ikke mottok e-posten') }}, <a href="{{ route('verification.resend') }}">{{ __('klikk her for å få en til') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
