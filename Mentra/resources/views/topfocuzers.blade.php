@extends('layouts.web')

@section('content')
<style>
    /* Premium Rank Styles */
    .rank-gold { 
        border-left: 8px solid #FFD700 !important; 
        background: linear-gradient(90deg, #fff9e6, #ffffff);
    }
    .rank-silver { 
        border-left: 8px solid #C0C0C0 !important; 
        background: linear-gradient(90deg, #f2f2f2, #ffffff);
    }
    .rank-bronze { 
        border-left: 8px solid #CD7F32 !important; 
        background: linear-gradient(90deg, #faf3ee, #ffffff);
    }
    .rank-default { 
        border-left: 8px solid #e9ecef !important; 
    }

    .leaderboard-card {
        transition: transform 0.2s;
        border: 1px solid rgba(0,0,0,.125);
    }
    .leaderboard-card:hover {
        transform: scale(1.02);
    }
    .trophy-icon { font-size: 1.5rem; }
</style>

<div class="container sec py-5">
    <h2 class="text-center mb-5 communityhead">🔥 Top 05 Focusers</h2>

    <div class="row justify-content-center">
        <div class="col-md-7"> @foreach ($topUsers as $index => $entry)
                @php
                    // Logic to assign the correct color class
                    $rankClass = 'rank-default';
                    $badge = '';
                    
                    if ($index === 0) {
                        $rankClass = 'rank-gold';
                        $badge = '';
                    } elseif ($index === 1) {
                        $rankClass = 'rank-silver';
                        $badge = '';
                    } elseif ($index === 2) {
                        $rankClass = 'rank-bronze';
                        $badge = '';
                    }

                    $hours = floor($entry->total_hours);
                    $minutes = round(($entry->total_hours - $hours) * 60);
                @endphp

                <div class="card mb-3 shadow-sm leaderboard-card {{ $rankClass }}">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <h4 class="me-4 mb-0 text-muted" style="width: 40px;">#{{ $index + 1 }}</h4>
                            <div>
                                <h5 class="card-title mb-0 font-weight-bold">
                                    {{ $entry->user->name ?? 'Anonymous' }}
                                </h5>
                                <p class="card-text mb-0 text-muted small">
                                    Total Study Time: <strong>{{ $hours }}h {{ $minutes }}m</strong>
                                </p>
                            </div>
                        </div>
                        <div class="trophy-icon">
                            {{ $badge }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <hr class="my-5 opacity-25">

    <div class="text-center mb-5">
        <h2 class="fw-bold">🎯 Study Challenges</h2>
        <p class="text-muted">Push your limits and earn badges</p>
    </div>

    <div class="row">
        @foreach ($challenges as $challenge)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm challenge-card">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-soft-info text-info border border-info badge-type">
                                {{ $challenge->type }}
                            </span>
                        </div>
                        <h5 class="fw-bold mb-3">{{ $challenge->name }}</h5>
                        <p class="text-muted small flex-grow-1">
                            {{ $challenge->description }}
                        </p>
                        <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection