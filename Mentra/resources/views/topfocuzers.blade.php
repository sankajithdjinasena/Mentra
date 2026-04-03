@extends('layouts.web')

@section('content')
    <div class="container sec py-5">
        <h2 class="text-center mb-4 communityhead">🔥 Top 05</h2>

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


    <div class="container sec py-5">
    <h2 class="text-center mb-4">🎯 Study Challenges</h2>

    <div class="row justify-content-center">
        @foreach ($challenges as $challenge)
        <div class="col-md-6">
            <div class="card mb-4 border-left-success shadow-sm chall-div">
                <div class="card-header bg-light">
                    <h5 class="mb-0">{{ $challenge->name }}</h5>
                </div>
                <div class="card-body">
                    <p>{{ $challenge->description }}</p>
                    <span class="badge bg-info text-white">{{ ucfirst($challenge->type) }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
