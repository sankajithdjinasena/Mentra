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
