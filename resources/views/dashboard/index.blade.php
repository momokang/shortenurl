@extends('layouts.default')

@section('content')
    <h1 class="mt-5">Urls</h1>
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>Url</th>
            <th>Shorten</th>
            <th>View</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($urls as $url)
                <tr>
                    <td>{{ $url->id }}</td>
                    <td>
                        <a href="{{ $url->url }}" target="_blank">
                            {{ $url->url }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('hash', $url->hashid) }}" target="_blank">
                            {{ $url->hashid }}
                        </a>
                    </td>
                    <td>{{ $url->impression }}</td>
                    <td>
                        <a href="{{ route('analytic', $url->hashid) }}" class="btn btn-secondary">Analytic</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $urls->links() }}
@endsection