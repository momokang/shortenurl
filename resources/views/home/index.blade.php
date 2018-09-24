@extends('layouts.default')

@section('content')
    <form method="post" class="my-5">
        @csrf
        <div class="form-group">
            <label for="url">URL to be shorten</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">http://</button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:;">http://</a>
                        <a class="dropdown-item" href="javascript:;">https://</a>
                    </div>
                </div>
                <input type="hidden" name="url_prefix" id="url_prefix" value="http://">
                <input type="text" name="url" class="form-control" id="url" aria-describedby="urlHelp" placeholder="www.url.com" autocomplete="off" required>
            </div>
            <small id="urlHelp" class="form-text text-muted">Your url will be shorten.</small>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
        </div>
    </form>
@endsection

@push('js')
    <script>
        $('.dropdown-menu .dropdown-item').click(function() {
             $('.dropdown-toggle').text($(this).text());
             $('#url_prefix').val($(this).text());
        });

        $('#url').keyup(function() {
            var txt = $(this).val();
            var regex = /^https?:\/\//;
            if (txt.match(regex)) {
                var matches = txt.match(regex);
                var url = matches[0];
                $(this).val(txt.replace(regex, ""));

                $('.dropdown-toggle').text(url);
                $('#url_prefix').val(url);
            }
        });
    </script>
@endpush