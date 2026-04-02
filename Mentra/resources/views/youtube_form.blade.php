@extends('layouts.web')

@section('content')
<title>Mentra | Youtube Check Feature</title>

<link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
<section class="container sec  wow fadeInDown">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Check Before Watch</h2>
            <form action="{{ route('analyze.youtube') }}" method="POST">
                @csrf
                <label for="youtube_url" class="mt-5">Enter YouTube Video URL:</label>
                <input type="text" name="youtube_url" id="youtube_url" required>
                <button type="submit">Analyze</button>
            </form>
            @if (isset($analysisResult))
            @if (session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @else
            <div class="alert alert-info mt-3">
                <p>Rating: {{ $analysisResult['rating'] }}/5</p>
                <p>Positive Comments: {{ $analysisResult['positive'] }}</p>
                <p>Negative Comments: {{ $analysisResult['negative'] }}</p>
                <p>Neutral Comments: {{ $analysisResult['neutral'] }}</p>
                <p>Total Comments: {{ $analysisResult['total_comments'] }}</p>
            </div>
            @endif
            @endif
        </div>
    </div>
</section>
@endsection