@extends('layouts.web')

@section('content')
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
