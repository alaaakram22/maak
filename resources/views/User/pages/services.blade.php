@include('user.partials.header')

<body class="about-page">
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-10">
                            <h1 class="heading-title  ">Choose Care Type</h1>
                            <p class="mb-0 ">
                                Select the type of caregiver you need

                            </p>
                        </div>
                        <section >
                            <div class="container">



                                <div class="row justify-content-center g-4">
                                    <!-- Non-Medical Caregiver -->
                                    <div class="col-md-5">
                                        <a href="{{url('caringcaregivers') }}" class="text-decoration-none">
                                            <div class="card shadow-lg border-0 h-100 care-card">

                                                <img src="{{ asset('user/assets/img/health/help-7.jpg') }}"
                                                    class="card-img-top"
                                                    style="height: 260px; object-fit: cover;">

                                                <div class="card-body text-center p-4">
                                                    <h3 class="fw-bold text-success">
                                                        👤 Caring Caregiver
                                                    </h3>
                                                    <p class="text-muted mt-3">
                                                        Assistance with daily activities, companionship, and general care support.
                                                    </p>
                                                </div>

                                            </div>
                                        </a>
                                    </div>

                                    <!-- Medical Caregiver -->
                                    <div class="col-md-5">
                                        <a href="{{ url('medicalcaregivers') }}" class="text-decoration-none">
                                            <div class="card shadow-lg border-0 h-100 care-card">

                                                <img src="{{ asset('user/assets/img/health/help-2.jpg') }}"
                                                    class="card-img-top"
                                                    style="height: 260px; object-fit: cover;">

                                                <div class="card-body text-center p-4">
                                                    <h3 class="fw-bold text-primary">
                                                        🩺 Medical Caregiver
                                                    </h3>
                                                    <p class="text-muted mt-3">
                                                        Certified caregivers with medical background for professional healthcare support.
                                                    </p>
                                                </div>

                                            </div>
                                        </a>
                                    </div>



                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

        </div><!-- End -->




        @include('user.partials.footer')