@include('user.partials.header')

<body class="booking-page bg-light">

    <main class="main">

        <section class="py-5" style="margin-top:120px;">

            <div class="container">

                {{-- ERRORS & WARNINGS --}}
                @if ($errors->any())
                <div class="alert alert-danger shadow-sm rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if(session('warning'))
                <div class="alert alert-warning shadow-sm rounded-3">
                    {{ session('warning') }}
                </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success shadow-sm rounded-3">
                    {{ session('success') }}
                </div>
                @endif

                <!-- CAREGIVER CARD -->
                <div class="row justify-content-center mb-5">

                    <div class="col-lg-10">

                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                            <div class="row g-0">

                                <!-- IMAGE -->
                                <div class="col-lg-4 d-flex align-items-center justify-content-center">

                                    <div class="text-center">

                                        <img src="{{ $caregiver->image_url }}"
                                             style="width:320px;height:320px;object-fit:cover;border-radius:50%;border:6px solid #fff;box-shadow:0 6px 18px rgba(0,0,0,0.12);">

                                        <!-- BADGE -->
                                        <div class="mt-3">

                                            @if($caregiver->medical_background)
                                            <span class="badge bg-primary px-3 py-2 rounded-pill shadow">
                                                🩺 Medical Caregiver
                                            </span>
                                            @else
                                            <span class="badge bg-success px-3 py-2 rounded-pill shadow">
                                                👤 Caregiver
                                            </span>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                                <!-- INFO -->
                                <div class="col-lg-8">

                                    <div class="p-5">

                                        <!-- NAME -->
                                        <div class="mb-3">

                                            <h1 class="fw-bold text-dark mb-1">
                                                {{ $caregiver->user->name }}
                                            </h1>

                                            <p class="text-muted fs-5 mb-0">
                                                {{ $caregiver->skills }}
                                            </p>

                                        </div>

                                        <!-- STATS -->
                                        <div class="row g-3 mt-4">

                                            <!-- EXPERIENCE -->
                                            <div class="col-md-6">

                                                <div class="d-flex align-items-center">

                                                    <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                                        <i class="bi bi-briefcase-fill text-warning fs-5"></i>
                                                    </div>

                                                    <div>
                                                        <small class="text-muted d-block">
                                                            Experience
                                                        </small>

                                                        <span class="fw-semibold">
                                                            {{ $caregiver->experience ?? 0 }}+ Years
                                                        </span>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>


                                        <!-- DETAILS -->
                                        <div class="mt-2">

                                            <div class="row gy-4">

                                                <div class="col-md-6">

                                                    <div class="d-flex align-items-center">

                                                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                                            <i class="bi bi-gender-ambiguous text-primary fs-5"></i>
                                                        </div>

                                                        <div>
                                                            <small class="text-muted d-block">
                                                                Gender
                                                            </small>

                                                            <span class="fw-semibold">
                                                                {{ $caregiver->user->gender }}
                                                            </span>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="d-flex align-items-center">

                                                        <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                                            <i class="bi bi-telephone-fill text-success fs-5"></i>
                                                        </div>

                                                        <div>
                                                            <small class="text-muted d-block">
                                                                Contact Number
                                                            </small>

                                                            <span class="fw-semibold">
                                                                {{ $caregiver->user->phone }}
                                                            </span>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="d-flex align-items-center">

                                                        <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                                            <i class="bi bi-award-fill text-warning fs-5"></i>
                                                        </div>

                                                        <div>
                                                            <small class="text-muted d-block">
                                                                Specialization
                                                            </small>

                                                            <span class="fw-semibold">
                                                                {{ $caregiver->skills }}
                                                            </span>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="d-flex align-items-center">

                                                        <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        </div>

                                                        <div>
                                                            <small class="text-muted d-block">
                                                                Average Rating
                                                            </small>

                                                            <span class="fw-semibold">
                                                                {{ $caregiver->average_rating ?? 'N/A' }}
                                                                @if($caregiver->average_rating)
                                                                    <small class="text-muted">({{ $caregiver->total_reviews }} reviews)</small>
                                                                @endif
                                                            </span>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <div class="d-flex align-items-center">

                                                        <div class="bg-danger bg-opacity-10 rounded-circle p-3 me-3">
                                                            <i class="bi bi-calendar-heart text-danger fs-5"></i>
                                                        </div>

                                                        <div>
                                                            <small class="text-muted d-block">
                                                                Availability
                                                            </small>

                                                            <span class="fw-semibold text-success">
                                                                Available for Booking
                                                            </span>
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <!-- ABOUT -->
                                    <div class="mt-5">

                                        <h5 class="fw-bold mb-3">
                                            About Caregiver
                                        </h5>

                                        <p class="text-muted lh-lg mb-0">

                                            Dedicated caregiver providing compassionate and professional care
                                            services
                                            tailored to patient needs with strong communication, reliability,
                                            and commitment to comfort and wellbeing.

                                        </p>

                                    </div>

                                    <!-- Reviews moved below the details card -->

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- BOOKING CARD -->
            <!-- REVIEWS SECTION (separate block under details card) -->
            <div class="row justify-content-center mt-4">

                <div class="col-lg-10">

                    <div class="card border-0 shadow-lg rounded-4 p-4">

                        <h5 class="fw-bold mb-3">Reviews</h5>

                        <div>
                            @if(($caregiver->reviews ?? null) && $caregiver->reviews->count())
                                @foreach($caregiver->reviews as $rev)
                                    <div class="mb-3 p-3 bg-white rounded-3 shadow-sm">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <strong>{{ $rev->customer->name ?? 'Customer' }}</strong>
                                                <div class="text-warning">
                                                    @for($i = 0; $i < $rev->rating; $i++)
                                                        ★
                                                    @endfor
                                                    @for($i = $rev->rating; $i < 5; $i++)
                                                        <span class="text-muted">☆</span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ $rev->created_at->format('M d, Y') }}</small>
                                        </div>
                                        <p class="mb-0 text-muted">{{ $rev->review ?? 'No review text provided.' }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">No reviews yet.</p>
                            @endif
                        </div>

                    </div>

                </div>

            </div>
            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="card border-0 shadow-lg rounded-4 p-5">

                        <div class="text-center mb-5">

                            <h2 class="fw-bold;">
                                Book an Appointment
                            </h2>

                            <p class="text-muted">
                                Select your preferred plan and booking date
                            </p>

                        </div>

                        <form method="POST" action="{{ route('booking.store') }}">
                            @csrf

                            <input type="hidden" name="caregiver_id" value="{{ $caregiver->id }}">
                            <!-- DATE -->
                            <div class="mb-4"> <label class="form-label fw-semibold"> Booking Date </label> <input
                                    type="date" name="booking_date" class="form-control form-control-lg rounded-3"
                                    required> </div>

                            <!-- PRICING OPTIONS -->
                            <div class="mb-5">

                                <label class="form-label fw-semibold mb-3">
                                    Choose Your Plan
                                </label>

                                <div class="row g-3">

                                    <!-- SESSION -->
                                    <div class="col-md-4">

                                        <label class="w-100">

                                            <input type="radio" name="booking_option" value="session"
                                                class="d-none plan-radio" checked>

                                            <div class="plan-card border rounded-4 p-4 text-center shadow-sm h-100">

                                                <div class="fs-1 mb-2">
                                                    🕒
                                                </div>

                                                <h5 class="fw-bold">
                                                    One Session
                                                </h5>

                                                <p class="text-muted small mb-3">
                                                    Perfect for quick help
                                                </p>

                                                <div class="fw-bold fs-3 text-primary">
                                                    800 EGP
                                                </div>

                                                <div class="text-decoration-line-through text-muted small">
                                                    1000 EGP
                                                </div>

                                            </div>

                                        </label>

                                    </div>

                                    <!-- WEEK -->
                                    <div class="col-md-4">

                                        <label class="w-100">

                                            <input type="radio" name="booking_option" value="week"
                                                class="d-none plan-radio">

                                            <div class="plan-card border rounded-4 p-4 text-center shadow-sm h-100">

                                                <div class="fs-1 mb-2">
                                                    📅
                                                </div>

                                                <h5 class="fw-bold">
                                                    Weekly Plan
                                                </h5>

                                                <p class="text-muted small mb-3">
                                                    Best for regular care
                                                </p>

                                                <div class="fw-bold fs-3 text-success">
                                                    5,200 EGP
                                                </div>

                                                <div class="text-decoration-line-through text-muted small">
                                                    6,500 EGP
                                                </div>

                                            </div>

                                        </label>

                                    </div>

                                    <!-- MONTH -->
                                    <div class="col-md-4">

                                        <label class="w-100">

                                            <input type="radio" name="booking_option" value="month"
                                                class="d-none plan-radio">

                                            <div class="plan-card border rounded-4 p-4 text-center shadow-sm h-100">

                                                <div class="fs-1 mb-2">
                                                    👑
                                                </div>

                                                <h5 class="fw-bold">
                                                    Monthly Plan
                                                </h5>

                                                <p class="text-muted small mb-3">
                                                    Full professional support
                                                </p>

                                                <div class="fw-bold fs-3 text-danger">
                                                    21,000 EGP
                                                </div>

                                                <div class="text-decoration-line-through text-muted small">
                                                    24,000 EGP
                                                </div>

                                            </div>

                                        </label>

                                    </div>

                                </div>

                            </div>

                            <!-- TOTAL PRICE -->
                            <div class="bg-light rounded-4 p-4 text-center mb-4">

                                <small class="text-muted d-block mb-2">
                                    Selected Plan Price
                                </small>

                                <div id="priceBox" class="display-5 fw-bold text-dark">
                                    800 EGP
                                </div>

                            </div>

                            <!-- STYLE -->
                            <style>
                            .plan-card {
                                transition: all 0.3s ease;
                                cursor: pointer;
                                background: white;
                            }

                            .plan-card:hover {
                                transform: translateY(-5px);
                                box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
                            }

                            .plan-radio:checked+.plan-card {
                                border: 2px solid #0d6efd;
                                background: #f0f7ff;
                                transform: scale(1.02);
                            }
                            </style>

                            <!-- SCRIPT -->
                            <script>
                            document.addEventListener("DOMContentLoaded", function() {

                                const radios = document.querySelectorAll(".plan-radio");
                                const priceBox = document.getElementById("priceBox");

                                const prices = {
                                    session: "800 EGP",
                                    week: "5,200 EGP",
                                    month: "21,000 EGP"
                                };

                                radios.forEach(radio => {

                                    radio.addEventListener("change", function() {

                                        priceBox.innerText = prices[this.value];

                                    });

                                });

                            });

                            document.addEventListener("DOMContentLoaded", function() {
                                const dateInput = document.getElementById("booking_date");

                                // set min date = today
                                const today = new Date().toISOString().split('T')[0];
                                dateInput.setAttribute("min", today);
                            });
                            </script>

                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3">
                                Confirm Booking
                            </button>

                        </form>

                    </div>

                </div>

            </div>

            </div>

        </section>

        <section class="py-5">

            <div class="container">

                <div class="text-center mb-5">

                    <h2 class="fw-bold"></h2>