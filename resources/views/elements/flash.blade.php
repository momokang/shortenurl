@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
@elseif (session('success'))
    <div class="alert alert-success">
        {!! session('success') !!}
    </div>
@endif