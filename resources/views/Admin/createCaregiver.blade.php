@extends('admin.layouts.layout')

@section('body')

<div class="container py-5">

<div class="row justify-content-center">

    <div class="col-lg-10">

        <!-- PAGE TITLE -->
        <div class="mb-4">
            <h2 class="font-weight-bold text-dark">Create Caregiver</h2>
            <p class="text-muted">Add a new caregiver profile with personal and professional details</p>
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

                        <form action="{{ route('caregivers.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- SECTION 1 -->
                            <h6 class="text-primary font-weight-bold mb-3">👤 Personal Information</h6>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <select name="gender" class="form-control">
                                        <option value="">Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <input type="date" name="date_of_birth" class="form-control">
                                </div>

                            </div>

                            <hr>

                            <!-- SECTION 2 -->
                            <h6 class="text-success font-weight-bold mb-3">🧑‍⚕️ Professional Details</h6>

                            <div class="form-group">
                                <input type="number" name="experience" class="form-control mb-3" placeholder="Experience (Years)" required>

                                <input type="text" name="skills" class="form-control mb-3" placeholder="Skills (e.g. elderly care, first aid)" required>

                                <input type="number" step="0.01" name="hourly_rate" class="form-control mb-3" placeholder="Hourly Rate">

                                <select name="medical_background" class="form-control mb-3">
                                    <option value="0">No Medical Background</option>
                                    <option value="1">Medical Background</option>
                                </select>

                                <input type="file" name="image" class="form-control">
                            </div>

                            <!-- SUBMIT -->
                            <div class="mt-4">
                                <button class="btn btn-primary btn-block py-2 font-weight-bold">
                                    Create Caregiver
                                </button>
                            </div>

                        </form>

                    </div>

                    <!-- RIGHT: INFO PANEL -->
                    <div class="col-lg-4 bg-light p-5 border-left">

                        <h6 class="font-weight-bold mb-3">ℹ️ Guidelines</h6>

                        <ul class="small text-muted pl-3">
                            <li>Make sure email is unique</li>
                            <li>Password must be at least 8 characters</li>
                            <li>Experience should be in years</li>
                            <li>Skills should be comma separated</li>
                        </ul>

                        <hr>

                        <h6 class="font-weight-bold">Status</h6>
                        <p class="small text-muted">
                            New caregivers are created with <strong>pending</strong> status by default.
                        </p>

                        <hr>

                        <a href="{{ route('allCaregivers') }}" class="btn btn-outline-secondary btn-sm btn-block">
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
