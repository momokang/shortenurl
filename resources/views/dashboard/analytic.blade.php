@extends('layouts.default')

@section('content')
    <h2 class="mt-5">
        Analytic of url `<small>{{ $url->url }}</small>`
        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary float-right">Back</a>
    </h2>

    <canvas id="lineChart"></canvas>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script>
        @php
            $dates = array_keys($data);
            $dates = '"' . implode('","', $dates) . '"';
            $values = implode(',', $data);
        @endphp
        var ctx = document.getElementById("lineChart").getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: [{!! $dates !!}],
                datasets: [{
                    label: 'Monthly',
                    data: [{!! $values !!}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
@endpush