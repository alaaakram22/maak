`@include('user.partials.header')

<body class="doctors-page">
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1 class="heading-title">Caring Caregivers</h1>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- End Page Title -->

        <!-- Doctors Section -->
        <section id="doctors" class="doctors section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    @forelse($caregivers as $caregiver)

                    <div class="col-lg-3 col-md-6">
                        <div class="doctor-card">

                            <div class="doctor-image">
                                <img
                                    src="{{ $caregiver->image_url }}"
                                    class="img-fluid rounded shadow"
                                    alt="Caregiver Image">
                            </div>

                            <div class="doctor-content">
                                <h4>{{ $caregiver->user->name }}</h4>

                                <span class="specialty">
                                    Caring Caregiver
                                </span>

                                <p>
                                    {{ $caregiver->skills ?? 'No skills provided' }}
                                </p>

                                <div class="doctor-meta">
                                    <div class="experience">
                                        <i class="bi bi-award"></i>
                                        <span>{{ $caregiver->experience ?? 0 }} Years Experience</span>
                                    </div>

                                    <!-- <div class="department">
                                        <i class="bi bi-star"></i>
                                        <span>Rating: {{ $caregiver->rating ?? 'N/A' }}</span>
                                    </div> -->
                                </div>

                                <a href="{{ route('caregiver.show', $caregiver->id) }}" class="btn-appointment">
                                    Book Appointment
                                </a>
                            </div>

                        </div>
                    </div>

                    @empty

                    <div class="text-center">
                        <h4>No caring caregivers available</h4>
                    </div>

                    @endforelse

                </div>

            </div>

        </section><!-- /Doctors Section -->

    </main>



</body>

@include('user.partials.footer')