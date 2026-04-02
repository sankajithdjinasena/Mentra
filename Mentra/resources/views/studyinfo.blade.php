@extends('layouts.web')

@section('content')
    <title>Mentra | Study Info</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <style>
        canvas {
            margin-top: 30px;
            width: 800px !important;
            height: 400px !important;
            border-radius: 10px;
            margin: 0 auto;
        }
    </style>
    <section class="container sec">
        <h2 class="mb-4">Log Your Study Hours</h2>

        <div class="content-wrapper row wow fadeInDown">
            <!-- Clock Section -->
            <div class="clock-section col-md-6">
                <div id="time">
                    <span class="digit" id="hr">00</span>
                    <span class="txt">Hr</span>
                    <span class="digit" id="min">00</span>
                    <span class="txt">Min</span>
                    <span class="digit" id="sec">00</span>
                    <span class="txt">Sec</span>
                    <span class="digit" id="count">00</span>
                </div>
                <div id="buttons">
                    <button class="btn" id="start">Start</button>
                    <button class="btn" id="stop">Stop</button>
                    <button class="btn" id="reset">Reset</button>
                </div>
            </div>

            <!-- Study Log Section -->
            <div class="study-section col-md-6">
                <form action="{{ route('studyinfo.store') }}" method="POST">
                    @csrf
                    <label>Date:</label>
                    <input type="date" name="date" value="{{ now()->toDateString() }}"
                        max="{{ now()->toDateString() }}" required>

                    <label>Study Hours:</label>
                    <input type="number" name="hours" step="0.1" required min="0" max="24"
                        placeholder="Enter hours studied" required>

                    <button type="submit">Save Study Info</button>
                </form>
            </div>
            <h3 class="mt-5">Your Study Logs for {{ now()->format('F Y') }}</h3>
            <canvas id="studyChart"></canvas>
        </div>
    </section>

    <!-- Success Notification -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = {!! json_encode($dates->keys()) !!};
            const data = {!! json_encode($dates->values()) !!};

            const ctx = document.getElementById('studyChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Study Hours',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>






    @if (session('badge'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var badgeModal = new bootstrap.Modal(document.getElementById('badgeModal'));
                badgeModal.show();
            });
        </script>
    @else
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
    @endif


    <!-- Badge Modal -->
    <div class="modal fade" id="badgeModal" tabindex="-1" role="dialog" aria-labelledby="badgeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title" id="badgeModalLabel">🎉 Congratulations!</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session('badge'))
                        <p>You have earned a new badge:</p>
                        <h4><strong>{{ session('badge')->badge_name }}</strong></h4>
                        <p>{{ session('badge')->type }}</p>
                        <p>You've achieved the {{ session('badge')->hours }}-hour study target!</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Awesome!</button>
                </div>
            </div>
        </div>
    </div>





@if (session('success') || session('motivation'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Stay Motivated!',
                html: `
                    <p>{{ session('success') }}</p>
                    @if (session('motivation'))
                        <hr>
                        <p style="color:#3f9610; font-weight:bold; font-size:25px;">
                            {{ session('motivation') }}
                        </p>
                    @endif
                `,
                confirmButtonColor: '#28a745',
                timer: 6000
            });
        });
    </script>
@endif




@endsection
