@extends('layouts.web')

@section('content')
    <title>Mentra | My Profile</title>
    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    
    <section class="container sec">
        <div class="row wow fadeInDown">
            <div class="col-md-7">
                <div class="profile-form mb-4">
                    <h3>Account Information</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small d-block">Full Name</label>
                            <p class="h5">{{ $user->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small d-block">Email Address</label>
                            <p class="h5">{{ $user->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <h3>Health Metrics</h3>
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Age</label>
                                <input type="number" name="age" class="form-control" value="{{ $profile->age ?? '' }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="male" {{ ($profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ ($profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">BMI</label>
                                <select name="bmi_category" class="form-select">
                                    @foreach(['Normal', 'Normal Weight', 'Obese', 'Overweight'] as $bmi)
                                        <option value="{{ $bmi }}" {{ ($profile->bmi_category ?? '') == $bmi ? 'selected' : '' }}>{{ $bmi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Blood Pressure (Sys/Dia)</label>
                                <div class="input-group">
                                    <input type="number" name="systolic_bp" class="form-control" value="{{ $profile->systolic_bp ?? '' }}" placeholder="Sys">
                                    <input type="number" name="diastolic_bp" class="form-control" value="{{ $profile->diastolic_bp ?? '' }}" placeholder="Dia">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Heart Rate (bpm)</label>
                                <input type="number" name="heart_rate" class="form-control" value="{{ $profile->heart_rate ?? '' }}">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit w-100 mt-2">Update Health Profile</button>
                    </form>
                </div>
            </div>

            <div class="col-md-5">
                <div class="profile-form">
                    <h3>Academic Results</h3>
                    <form action="{{ route('courses.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row g-2">
                            <div class="col-7">
                                <input type="text" name="subject_name" class="form-control" placeholder="Subject/Course" required>
                            </div>
                            <div class="col-3">
                                <input type="text" name="result" class="form-control" placeholder="Grade" required>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn-submit w-100">+</button>
                            </div>
                        </div>
                    </form>

                    <ul class="list-group list-group-flush">
                        @forelse($user->courses as $course)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>{{ $course->subject_name }}</span>
                                <span class="badge bg-primary rounded-pill">{{ $course->result }}</span>
                            </li>
                        @empty
                            <p class="text-muted">No academic records added yet.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <style>
        .btn-submit {
            background-color: #5d59af;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
        }
        .profile-form {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
        h3 { color: #5d59af; font-size: 1.25rem; margin-bottom: 20px; font-weight: 700; }
        .list-group-item { border-bottom: 1px dashed #ddd; background: transparent; }
    </style>
@endsection