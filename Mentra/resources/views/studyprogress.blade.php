@extends('layouts.web')

@section('content')
    <title>Mentra | Study Progress</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <div class="container sec  wow fadeInDown">
        <h2 class="text-center">📊 Study Progress</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="chart-container mt-4">
                    <h4 class="text-center">Daily Progress ({{ now()->format('F Y') }})</h4>
                    <canvas id="dailyProgressChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4 class="text-center">Monthly Progress ({{ now()->year }})</h4>
                    <canvas id="monthlyProgressChart"></canvas>
                </div>
            </div>
        </div>

        <div class="text-center mt-2">
            <button id="downloadPdf" class="btn btn-primary">📄 Download PDF</button>
        </div>

        <div class="text-center mt-4">
            <h5>🔗 Share your progress</h5>
            <a id="shareImage" target="_blank" class="btn btn-primary m-1">Facebook </a>
            <a id="shareImage" target="_blank" class="btn btn-danger m-1">Instagram</a>
            <a id="shareImage" target="_blank" class="btn btn-success m-1">WhatsApp</a>
        </div>


        <!-- @if($profile)
    <form action="{{ route('sleepredict_result') }}" method="POST">
        @csrf

        <div class="text-center mt-4">
            <button type="submit">Check Sleep</button>
        </div>
    </form>

    @if(isset($predictedSleepDuration))
    @php
        $hours = floor($predictedSleepDuration);
        $minutes = round(($predictedSleepDuration - $hours) * 60);
    @endphp

    <div class="alert alert-success text-center mt-4 w-50 mx-auto">
        <h4>😴 Predicted Sleep Duration</h4>
        <h2>{{ $hours }} hrs {{ $minutes }} mins</h2>
    </div>
@endif
@endif -->



@if($profile)
<div class="card border-0 shadow-lg p-4 rounded-4 mt-5 mb-5 bg-white overflow-hidden position-relative">
    <div style="position: absolute; top: -20px; right: -20px; font-size: 100px; opacity: 0.05; transform: rotate(15deg);">😴</div>

    <div class="row align-items-center">
        <div class="col-md-12 text-start">
            <h3 class="fw-bold mb-3 align-items-center" >
                <span class="me-2">😴</span> Check Your Sleep Health
            </h3>
            <p class="text-muted fs-5 fw-light italic" style="text-align: justify; padding:60px;">
            <span class="d-block mb-2" style="color: #28a745; font-weight: 600;">Did you know?</span>
            Your sleep directly affects your concentration, memory, and daily performance. 
            Check your predicted sleep duration and discover whether your body gets enough rest for 
            <span class="text-dark fw-bold">better study success.</span>
        </p>
        </div>
        <div class="col-md-12 text-center">
            <form action="{{ route('sleepredict_result') }}" method="POST">
                @csrf
                <button type="submit" style="width: fit-content;
    margin: auto;">
                    Predict My Sleep Duration
                </button>
            </form>
        </div>


    @if(isset($predictedSleepDuration))
        @php
            $hours = floor($predictedSleepDuration);
            $minutes = round(($predictedSleepDuration - $hours) * 60);
        @endphp

      <div class="mt-4 animate-fade-in d-flex justify-content-center row">
    <div class="p-4 rounded-4 text-center col-11 col-md-6 shadow-sm" 
         style="background: linear-gradient(135deg, #f0f7ff 0%, #e0efff 100%); border: 1px dashed #0d6efd;">
        
        <h6 class="text-uppercase fw-bold text-primary mb-2 small tracking-wider">
            Your Personalized Forecast
        </h6>
        
        <div class="display-5 fw-bold text-dark">
            {{ $hours }}<span class="fs-4 fw-normal text-secondary">h</span> 
            {{ $minutes }}<span class="fs-4 fw-normal text-secondary">m</span>
        </div>
        
        <p class="text-muted mb-0 mt-2 small">
            Recommended rest based on your current Health data.
        </p>
    </div>
</div>
    </div>
    @endif
</div>
</div>
<style>
    /* Creative Styles */
    .rounded-4 { border-radius: 1.25rem !important; }
    .transition-all { transition: all 0.3s ease; }
    .hover-grow:hover { 
        transform: scale(1.05); 
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .tracking-wider { letter-spacing: 1px; }
    
    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endif




        <div class="mt-5">
            <h3 class="text-center">🏅 Badges Earned</h3>
            <div class="row mt-4">
                @foreach ($badges as $badge)
                    <div class="col-md-3">
                        <div class="card text-center shadow-sm mb-4" style="border-radius: 15px;">
                            <div class="card-body" style="width: 100%;">
                                <img src="{{ asset('img/badges/badge2.png') }}" alt="{{ $badge->badge_name }}"
                                    class="img-fluid mb-3" style="max-height: 100px;">
                                <h5 class="card-title">{{ $badge->badge_name }}</h5>
                                <p class="badge bg-success text-white p-2" style="font-size: 14px;">Earned
                                    {{ $badge->earn_count }} times</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dailyCtx = document.getElementById('dailyProgressChart').getContext('2d');
            new Chart(dailyCtx, {
                type: 'bar',
                data: {
                    labels: @json($dateLabels),
                    datasets: [{
                        label: 'Study Hours',
                        data: @json($studyHours),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Hours'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    }
                }
            });

            const monthlyCtx = document.getElementById('monthlyProgressChart').getContext('2d');
            new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: @json($monthLabels),
                    datasets: [{
                        label: 'Total Study Hours',
                        data: @json($monthlyHours),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Hours'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.getElementById('downloadPdf').addEventListener('click', function() {
            const {
                jsPDF
            } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');
            const charts = document.querySelector('.row');

            html2canvas(charts).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 10, pdfWidth, pdfHeight);
                pdf.save('study_progress.pdf');
            });
        });

        document.getElementById('shareImage').addEventListener('click', function() {
            const shareArea = document.querySelector('.row');

            html2canvas(shareArea).then(canvas => {
                canvas.toBlob(function(blob) {
                    const file = new File([blob], 'progress.png', {
                        type: 'image/png'
                    });

                    if (navigator.canShare && navigator.canShare({
                            files: [file]
                        })) {
                        navigator.share({
                            title: 'My Study Progress',
                            text: 'Here’s my study progress!',
                            files: [file]
                        }).catch(console.error);
                    } else {
                        alert(
                            'Sharing not supported on this browser. You can download the image and post it manually.'
                            );
                    }
                });
            });
        });
    </script>
@endsection
