@extends('layouts.web')

@section('content')
    <div class="container sec py-5">
        <h2 class="text-center mb-4 communityhead">🔥 Top 10</h2>

        <div class="row justify-content-center">
            @foreach ($topUsers as $index => $entry)
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card mb-3 shadow-sm border-left-primary">
                        <div class="card-body">
                            <h5 class="card-title">#{{ $index + 1 }} {{ $entry->user->name ?? 'Anonymous' }}</h5>
                            <p class="card-text">
                                @php
                                    $hours = floor($entry->total_hours);
                                    $minutes = round(($entry->total_hours - $hours) * 60);
                                @endphp

                                <strong>Total Study Time:</strong> {{ $hours }}h {{ $minutes }}m

                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
