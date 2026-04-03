@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1 style="text-align:center;" class="mb-5">Challenges</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach ($challenges as $challenge)
            <div class="col-md-4">
                <div class="card card-success position-relative chall-div">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">{{ $challenge->name }}</h3>
                        <form action="{{ route('challenges.destroy', $challenge->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this challenge?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger" title="Mark as inactive" style="margin-left: 15pc;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <p><strong>Description:</strong> {{ $challenge->description }}</p>
                        <p><strong>Type:</strong> {{ ucfirst($challenge->type) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection
