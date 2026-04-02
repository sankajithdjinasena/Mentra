{{-- @extends('layouts.web')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <section class="container sec">
    <form action="{{ route('sleepredict_result') }}" method="POST">
        @csrf <!-- Laravel's CSRF protection -->

        <!-- Age -->
        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" name="Age" id="age" class="form-control" required>
        </div>

        <!-- Quality of Sleep -->
        <div class="mb-3">
            <label for="quality_of_sleep" class="form-label">Quality of Sleep</label>
            <select name="Quality_of_Sleep" id="quality_of_sleep" class="form-select" required>
                <option value="" disabled selected>Select Quality of Sleep</option>
                <option value="3">Poor</option>
                <option value="6">Average</option>
                <option value="9">Good</option>
            </select>
        </div>

        <!-- Physical Activity Level -->
        <div class="mb-3">
            <label for="physical_activity_level" class="form-label">Physical Activity Level</label>
            <select name="Physical_Activity_Level" id="physical_activity_level" class="form-select" required>
                <option value="" disabled selected>Select Activity Level</option>
                <option value="30">Low</option>
                <option value="60">Moderate</option>
                <option value="90">High</option>
            </select>
        </div>

        <!-- Stress Level -->
        <div class="mb-3">
            <label for="stress_level" class="form-label">Stress Level</label>
            <select name="Stress_Level" id="stress_level" class="form-select" required>
                <option value="" disabled selected>Select Stress Level</option>
                <option value="3">Low</option>
                <option value="6">Moderate</option>
                <option value="9">High</option>
            </select>
        </div>

        <!-- Heart Rate -->
        <div class="mb-3">
            <label for="heart_rate" class="form-label">Heart Rate (bpm)</label>
            <input type="number" name="Heart_Rate" id="heart_rate" class="form-control" required>
        </div>

        <!-- Daily Steps -->
        <div class="mb-3">
            <label for="daily_steps" class="form-label">Daily Steps</label>
            <input type="number" name="Daily_Steps" id="daily_steps" class="form-control" required>
        </div>

        <!-- Gender -->
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <div class="form-check">
                <input type="radio" name="gender" id="gender_female" value="female" class="form-check-input" required>
                <label for="gender_female" class="form-check-label">Female</label>
            </div>
            <div class="form-check">
                <input type="radio" name="gender" id="gender_male" value="male" class="form-check-input" required>
                <label for="gender_male" class="form-check-label">Male</label>
            </div>
        </div>

        <!-- BMI -->
        <div class="mb-3">
            <label class="form-label">BMI Category</label>
            <div class="form-check">
                <input type="radio" name="bmi" id="bmi_normal" value="normal" class="form-check-input" required>
                <label for="bmi_normal" class="form-check-label">Normal</label>
            </div>
            <div class="form-check">
                <input type="radio" name="bmi" id="bmi_normal_weight" value="normal_weight" class="form-check-input"
                    required>
                <label for="bmi_normal_weight" class="form-check-label">Normal Weight</label>
            </div>
            <div class="form-check">
                <input type="radio" name="bmi" id="bmi_obese" value="obese" class="form-check-input" required>
                <label for="bmi_obese" class="form-check-label">Obese</label>
            </div>
            <div class="form-check">
                <input type="radio" name="bmi" id="bmi_overweight" value="overweight" class="form-check-input"
                    required>
                <label for="bmi_overweight" class="form-check-label">Overweight</label>
            </div>
        </div>

        <!-- Systolic BP -->
        <div class="mb-3">
            <label for="systolic_bp" class="form-label">Systolic Blood Pressure</label>
            <input type="number" name="Systolic_BP" id="systolic_bp" class="form-control" required>
        </div>

        <!-- Diastolic BP -->
        <div class="mb-3">
            <label for="diastolic_bp" class="form-label">Diastolic Blood Pressure</label>
            <input type="number" name="Diastolic_BP" id="diastolic_bp" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="">Submit</button>

    </form>
    </section>
@endsection --}}



@extends('layouts.web')

@section('content')
    <title>Mentra | Sleep Time Predictor</title>

    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <section class="container sec  wow fadeInDown">
        <h2>Check your sleep time</h2>
        <form action="{{ route('sleepredict_result') }}" method="POST">
            @csrf
            <div class="row mt-5">
                <div class="col-md-4">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" name="Age" id="age" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="heart_rate" class="form-label">Heart Rate (bpm)</label>
                    <input type="number" name="Heart_Rate" id="heart_rate" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="daily_steps" class="form-label">Daily Steps</label>
                    <input type="number" name="Daily_Steps" id="daily_steps" class="form-control" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="quality_of_sleep" class="form-label">Quality of Sleep</label>
                    <select name="Quality_of_Sleep" id="quality_of_sleep" class="form-select" required>
                        <option value="" disabled selected>Select Quality of Sleep</option>
                        <option value="3">Poor</option>
                        <option value="6">Average</option>
                        <option value="9">Good</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="physical_activity_level" class="form-label">Physical Activity Level</label>
                    <select name="Physical_Activity_Level" id="physical_activity_level" class="form-select" required>
                        <option value="" disabled selected>Select Activity Level</option>
                        <option value="30">Low</option>
                        <option value="60">Moderate</option>
                        <option value="90">High</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="stress_level" class="form-label">Stress Level</label>
                    <select name="Stress_Level" id="stress_level" class="form-select" required>
                        <option value="" disabled selected>Select Stress Level</option>
                        <option value="3">Low</option>
                        <option value="6">Moderate</option>
                        <option value="9">High</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender_female" value="female" class="form-check-input"
                                required>
                            <label for="gender_female" class="form-check-label">Female</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender_male" value="male" class="form-check-input"
                                required>
                            <label for="gender_male" class="form-check-label">Male</label>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">BMI Category</label>
                    <div class="d-flex flex-wrap gap-3">
                        <div class="form-check">
                            <input type="radio" name="bmi" id="bmi_normal" value="normal" class="form-check-input"
                                required>
                            <label for="bmi_normal" class="form-check-label">Normal</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="bmi" id="bmi_normal_weight" value="normal_weight"
                                class="form-check-input" required>
                            <label for="bmi_normal_weight" class="form-check-label">Normal Weight</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="bmi" id="bmi_obese" value="obese" class="form-check-input"
                                required>
                            <label for="bmi_obese" class="form-check-label">Obese</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="bmi" id="bmi_overweight" value="overweight"
                                class="form-check-input" required>
                            <label for="bmi_overweight" class="form-check-label">Overweight</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="systolic_bp" class="form-label">Systolic Blood Pressure</label>
                    <input type="number" name="Systolic_BP" id="systolic_bp" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="diastolic_bp" class="form-label">Diastolic Blood Pressure</label>
                    <input type="number" name="Diastolic_BP" id="diastolic_bp" class="form-control" required>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="">Submit</button>
            </div>

        </form>
        @if (@isset($predictedSleepDuration))
            <div class="row ">
                <div class="col-md-4 offset-md-4 mt-5 alert alert-info">
                    <h3>Your Sleep Time Must Be</h3>
                    <div class="d-flex align-items-center">
                        <input type="number" class="form-control w-auto" style="margin-left: 50px;" value="{{ number_format($predictedSleepDuration, 2) }}" step="0.01" readonly>
                        <span class="me-2">&nbsp;&nbsp;Hours</span>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
