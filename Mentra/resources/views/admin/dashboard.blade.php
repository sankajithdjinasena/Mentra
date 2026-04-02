@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <h1 style="text-align:center;" class="mb-5">Mentra Admin Dashboard</h1>

        <div class="text-center mb-4">
            <img src="{{ asset('img/logo-png - Copy.png') }}" alt="Mentra Logo" style="height: 165px;">
        </div>

        <div class="row">

            {{-- Users --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1">
                        <i class="fas fa-user-graduate"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Users</span>
                        <span class="info-box-number">{{ $userCount }}</span>
                    </div>
                </div>
            </div>

            {{-- Study Hours --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1">
                        <i class="fas fa-hourglass-half"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Study Hours</span>
                        <span class="info-box-number">{{ number_format($totalStudyHours) }}</span>
                    </div>
                </div>
            </div>

            {{-- Challenges --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1">
                        <i class="fas fa-bolt"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Challenges</span>
                        <span class="info-box-number">{{ $activeChallenges }}</span>
                    </div>
                </div>
            </div>

            {{-- Feedbacks --}}
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1">
                        <i class="fas fa-comment-dots"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Feedbacks</span>
                        <span class="info-box-number">{{ $feedbackCount }}</span>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
