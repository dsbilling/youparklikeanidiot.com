@extends('layouts.app')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ route('page.update', $slug) }}">

                <div class="form-group row">
                    <label for="title" class="col-2 col-form-label text-md-right">{{ __('Tittel') }}</label>
                    <div class="col-10">
                        <input id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $title ?? old('title') }}">
                        @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-2 col-form-label text-md-right">{{ __('Innhold') }}</label>
                    <div class="col-10">
                        <div id="summernote"></div>
                        <textarea name="content" id="content" class="invisible">{{ old('content') }}</textarea>
                        @if ($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <hr>

                <div class="form-group row">
                    <div class="col-2 ml-auto">
                    	@method('PATCH')
                        @csrf
                        <button class="btn btn-success btn-block"><i class="fas fa-save"></i> {{ _('Lagre') }}</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script>
        $('#summernote').summernote({
            placeholder: '',
            tabsize: 2,
            height: 250
        });

        var markupStr = "{{ $content ?? old('content') }}";
        $('#summernote').summernote('code', markupStr);

        $('#summernote').on('summernote.change', function(we, e) {
            var markupStr = $('#summernote').summernote('code');
            document.getElementById("content").value = markupStr;
        });
    </script>
@endsection