@extends('admin.layouts.layout')

@section('body')

<div class="container py-5">

<div class="row justify-content-center">


<div class="col-lg-10">

    <!-- PAGE TITLE -->
    <div class="mb-4">
        <h2 class="font-weight-bold text-dark">Update Caregiver</h2>
        <p class="text-muted">Edit caregiver personal and professional details</p>
    </div>

    <div class="card border-0 shadow-lg">

        <div class="card-body p-0">

            <div class="row">

                <!-- LEFT: FORM -->
                <div class="col-lg-8 p-5">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('caregivers.update', $caregiver->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- SECTION 1 -->
                        <h6 class="text-primary font-weight-bold mb-3">👤 Personal Information</h6>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="text" name="name"
                                       value="{{ old('name', $caregiver->user->name) }}"
                                       class="form-control"
                                       placeholder="Full Name" required>
                            </div>

                            <div class="form-group col-md-6">
                                <input type="email" name="email"
                                       value="{{ old('email', $caregiver->user->email) }}"
                                       class="form-control"
                                       placeholder="Email Address" required>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <input type="text" name="phone"
                                       value="{{ old('phone', $caregiver->user->phone) }}"
                                       class="form-control"
                                       placeholder="Phone Number" required>
                            </div>

                            <div class="form-group col-md-6">
                                <select name="gender" class="form-control">
                                    <option value="Male" {{ $caregiver->user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ $caregiver->user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <input type="date" name="date_of_birth"
                                   value="{{ old('date_of_birth', $caregiver->user->date_of_birth) }}"
                                   class="form-control">
                        </div>

                        <hr>

                        <!-- SECTION 2 -->
                        <h6 class="text-success font-weight-bold mb-3">🧑‍⚕️ Professional Details</h6>

                        <div class="form-group">

                            <input type="number" name="experience"
                                   value="{{ old('experience', $caregiver->experience) }}"
                                   class="form-control mb-3"
                                   placeholder="Experience (Years)" required>

                            <input type="text" name="skills"
                                   value="{{ old('skills', $caregiver->skills) }}"
                                   class="form-control mb-3"
                                   placeholder="Skills" required>

                            <input type="number" step="0.01" name="hourly_rate"
                                   value="{{ old('hourly_rate', $caregiver->hourly_rate) }}"
                                   class="form-control mb-3"
                                   placeholder="Hourly Rate">

                            <select name="medical_background" class="form-control mb-3">
                                <option value="0" {{ !$caregiver->medical_background ? 'selected' : '' }}>No Medical Background</option>
                                <option value="1" {{ $caregiver->medical_background ? 'selected' : '' }}>Medical Background</option>
                            </select>

                            <!-- IMAGE -->
                            <div class="mb-3">
                                <input type="file" name="image" class="form-control">

                                @if($caregiver->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/'.$caregiver->image) }}"
                                             width="80"
                                             class="rounded border">
                                    </div>
                                @endif
                            </div>

                        </div>

                        <!-- SUBMIT -->
                        <div class="mt-4">
                            <button class="btn btn-success btn-block py-2 font-weight-bold">
                                Update Caregiver
                            </button>
                        </div>

                    </form>

                </div>

                <!-- RIGHT PANEL -->
                <div class="col-lg-4 bg-light p-5 border-left">

                    <h6 class="font-weight-bold mb-3">ℹ️ Guidelines</h6>

                    <ul class="small text-muted pl-3">
                        <li>Email should remain unique</li>
                        <li>Image is optional unless changed</li>
                        <li>Leave fields unchanged if not needed</li>
                    </ul>

                    <hr>

                    <h6 class="font-weight-bold">Current Status</h6>

                    <p class="small text-muted">
                        <strong>{{ ucfirst($caregiver->status) }}</strong>
                    </p>

                    <hr>

                    <a href="{{ route('allCaregivers') }}"
                       class="btn btn-outline-secondary btn-sm btn-block">
                        ← Back to List
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


</div>

</div>

@endsection
