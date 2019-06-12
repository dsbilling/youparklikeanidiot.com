@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="m-auto">Søk ditt regnr her:</h3>
            <form class="form-inline">
                <i class="fas fa-search" aria-hidden="true"></i>
                <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="AA 12345" aria-label="AA 12345">
            </form>
        </div>
    </div>
</div>
@endsection
