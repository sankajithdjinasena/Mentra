@extends('layouts.web')

@section('content')
    <title>Mentra | My Profile</title>
    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    
    <section class="container sec">
        <div class="row wow fadeInDown">
            <div class="col-md-7">
                <div class="profile-form mb-4">
                    <h3>Account Information</h3>


                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mb-5">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-4 text-center">
                                    <div class="profile-image-container mb-2">
                                        <img src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('images/default-avatar.png') }}" 
                                            alt="Profile" id="imagePreview" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #439a0d;">
                                    </div>
                                    <label style="cursor:pointer;color:#196730;">
                                        Change
                                        <input type="file" name="profile_image" class="d-none" onchange="previewFile()">
                                    </label>
                                </div>

                                </div>
                            <button type="submit" class="btn-submit profile-btn mt-2">Update Profile Image</button>
                        </form>

                        <script>
                            function previewFile() {
                                const preview = document.querySelector('#imagePreview');
                                const file = document.querySelector('input[type=file]').files[0];
                                const reader = new FileReader();

                                reader.addEventListener("load", function () {
                                    preview.src = reader.result;
                                }, false);

                                if (file) {
                                    reader.readAsDataURL(file);
                                }
                            }
                        </script>


                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small d-block">Full Name</label>
                            <p class="h5">{{ $user->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted small d-block">Email Address</label>
                            <p class="h5">{{ $user->email }}</p>
                        </div>
                           <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                        <div class="col-md-4 mb-3">
                        <label class="form-label text-muted small d-block">Mobile Number</label>
                        <input type="text" name="mobile" class="form-control" value="{{ $profile->mobile ?? '' }}" placeholder="+947XXXXXXXX">
                    </div>
                    </div>
                    <hr>
                    <div class="profile-form mb-4">
                <h3>Health Metrics</h3>
             
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" value="{{ $profile->age ?? '' }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="male" {{ ($profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ ($profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">BMI Category</label>
                            <select name="bmi_category" class="form-select" required>
                                @foreach(['Normal', 'Normal Weight', 'Obese', 'Overweight'] as $bmi)
                                    <option value="{{ $bmi }}" {{ ($profile->bmi_category ?? '') == $bmi ? 'selected' : '' }}>{{ $bmi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Heart Rate (bpm)</label>
                            <input type="number" name="heart_rate" class="form-control" value="{{ $profile->heart_rate ?? '' }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Systolic BP</label>
                            <input type="number" name="systolic_bp" class="form-control" value="{{ $profile->systolic_bp ?? '' }}" placeholder="e.g., 120" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Diastolic BP</label>
                            <input type="number" name="diastolic_bp" class="form-control" value="{{ $profile->diastolic_bp ?? '' }}" placeholder="e.g., 80" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sleep Quality (1-10)</label>
                            <input type="number" name="quality_of_sleep" class="form-control" min="1" max="10" value="{{ $profile->quality_of_sleep ?? '' }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Activity Level (1-100)</label>
                            <input type="number" name="physical_activity_level" class="form-control" min="1" max="100" value="{{ $profile->physical_activity_level ?? '' }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Stress Level (1-10)</label>
                            <input type="number" name="stress_level" class="form-control" min="1" max="10" value="{{ $profile->stress_level ?? '' }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit profile-btn mt-2">Update Profile</button>
                </form>
            </div>
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
                                <span class="badge rounded-pill" style="color:#439a0d">{{ $course->result }}</span>
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
            background-image: linear-gradient(90deg, #196730, #439a0d) !important;
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
        h3 {  color:  #196730; font-size: 1.25rem; margin-bottom: 20px; font-weight: 700; }
        .list-group-item { border-bottom: 1px dashed #ddd; background: transparent; }
    </style>
@endsection