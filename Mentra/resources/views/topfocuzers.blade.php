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
</div>
@endsection