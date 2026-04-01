@extends('layouts.web')

@section('content')
    <title>FocusZen | Reminders</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <section class="container sec">
        <div class="container row  wow fadeInDown">
            <div class="col-md-6">
                <h2>Reminders</h2>
                <form action="{{ route('reminders.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" name="date"  min="{{ now()->toDateString() }}" value="{{ now()->toDateString() }}" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" class="form-control" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="reminder">Reminder:</label>
                        <input type="text" class="form-control" name="reminder" required>
                    </div>
                    <button type="submit" class=" mt-2">Add Reminder</button>
                </form>
            </div>
            <div class="col-md-6">
            <h2>Your Upcoming Reminders</h2>
            <ul class="list-group mt-4">
                @forelse ($reminders as $reminder)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        <strong>{{ $reminder->reminder }}</strong> - {{ $reminder->date }} at {{ $reminder->time }}
                    </span>
                    <form action="{{ route('reminders.destroy', $reminder->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reminder?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
                @empty
                    <li class="list-group-item">No upcoming reminders.</li>
                @endforelse
            </ul>
            </div>

        </div>
    </section>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#28a745',
                    timer: 3000
                });
            });
        </script>
    @endif
@endsection
