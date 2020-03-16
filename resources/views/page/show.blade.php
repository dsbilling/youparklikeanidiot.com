@extends('layouts.app')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(Auth::user())
                @if(Auth::user()->hasRole('write'))
                    <p class="text-right">
                        <a href="{{ route('page.edit', $slug) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit mr-1"></i> Edit</a>
                        <a href="javascript:;" onclick="jQuery('#page-destroy').modal('show', {backdrop: 'static'});" class="btn btn-danger btn-sm"><i class="fa fa-trash mr-2"></i>Delete</a>
                    </p>
                @endif
            @endif
            <p class="display-4">{{ $title }}</p>
            <hr>
            {!! $content !!}
        </div>
    </div>
</div>

<div class="modal fade" id="page-destroy" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><strong>Delete Page:</strong> #{{ $id }} - {{ $title }}</h4>
            </div>
            <div class="modal-body">
                <h4 class="text-danger text-center"><strong>Are you sure you want to delete this page?</strong></h4>
            </div>
            <div class="modal-footer">
                <form action="{{ route('page.destroy', $slug) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Yes, I want to delete it.</button>
                </form>
                <button type="button" class="btn btn-success" data-dismiss="modal">No, take me away!</button>
            </div>
        </div>
    </div>
</div>
@endsection