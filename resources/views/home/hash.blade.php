@extends('layouts.default')

@section('content')

    <div class="jumbotron mt-5">
        <h1>Your url had been shorten</h1>
        <p class="lead">Copy your url and share to your friend!</p>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" id="btn-copy">Copy</button>
            </div>
            <input type="text" class="form-control" value="{{ route('url', $url->hashid) }}" id="txt-copy">
            <div class="valid-feedback">Copied!</div>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('home') }}" class="btn btn-log btn-primary">Back to Home</a>
    </div>
@endsection

@push('js')
    <script>
        $('#btn-copy').click(function() {
            $('#txt-copy').select();
            document.execCommand("copy");
            $('.form-control').addClass('is-valid');
        });
    </script>
@endpush