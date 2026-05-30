@include('user.partials.header')

<body>

<main class="main pt-5 bg-light min-vh-100">

    <div class="container py-5">

        <div class="bg-white shadow rounded-4 p-4">

            <!-- PAGE TITLE -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h2 class="fw-bold mb-1">My Bookings</h2>
                    <p class="text-muted mb-0">
                        View your upcoming and past bookings
                    </p>
                </div>

            </div>

            <!-- TABS -->
            <ul class="nav nav-pills mb-4" id="bookingTabs" role="tablist">

                <li class="nav-item me-2" role="presentation">

                    <button class="nav-link active px-4 py-2"
                        id="upcoming-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#upcoming"
                        type="button"
                        role="tab">

                        Upcoming Bookings

                    </button>

                </li>

                <li class="nav-item" role="presentation">

                    <button class="nav-link px-4 py-2"
                        id="history-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#history"
                        type="button"
                        role="tab">

                        Booking History

                    </button>

                </li>

            </ul>

            <div class="tab-content">

                <!-- UPCOMING BOOKINGS -->
                <div class="tab-pane fade show active"
                    id="upcoming"
                    role="tabpanel">

                    @php
                        $upcomingBookings = $bookings->filter(function ($booking) {
                            return $booking->booking_date >= now()->startOfDay();
                        });
                    @endphp

                    @if($upcomingBookings->count())

                        <div class="row g-4">

                            @foreach($upcomingBookings as $booking)

                                <div class="col-md-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100">

                                        <div class="card-body p-4">

                                            <div class="d-flex justify-content-between align-items-start mb-3">

                                                <div>
                                                    <h5 class="fw-bold mb-1">
                                                        {{ $booking->caregiver->user->name }}
                                                    </h5>

                                                    <span class="badge bg-primary">
                                                        Upcoming
                                                    </span>
                                                </div>

                                                <div class="text-end">

                                                    <div class="fw-bold text-success">
                                                        {{ number_format($booking->price) }} EGP
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="mb-2">
                                                <i class="bi bi-calendar-event text-primary me-2"></i>

                                                {{ $booking->booking_date->format('F j, Y') }}
                                            </div>

                                            <div class="mb-3">
                                                <i class="bi bi-heart-pulse text-danger me-2"></i>

                                                {{ ucfirst($booking->booking_option) }}
                                            </div>

                                            <div>

                                                @if($booking->payment_status === 'paid')

                                                    <span class="badge bg-success">
                                                        Confirmed
                                                    </span>

                                                @else

                                                    <span class="badge bg-warning text-dark">
                                                        Pending Payment
                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="text-center py-5">

                            <i class="bi bi-calendar-x text-secondary"
                                style="font-size: 4rem;"></i>

                            <h4 class="mt-3 fw-bold">
                                No Upcoming Bookings
                            </h4>

                            <p class="text-muted">
                                You currently have no upcoming bookings.
                            </p>

                        </div>

                    @endif

                </div>

                <!-- BOOKING HISTORY -->
                <div class="tab-pane fade"
                    id="history"
                    role="tabpanel">

                    @php
                        $pastBookings = $bookings->filter(function ($booking) {
                            return $booking->booking_date < now()->startOfDay();
                        });
                    @endphp

                    @if($pastBookings->count())

                        <div class="row g-4">

                            @foreach($pastBookings as $booking)

                                <div class="col-md-6">

                                    <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">

                                        <div class="card-body p-4">

                                            <div class="d-flex justify-content-between align-items-start mb-3">

                                                <div>

                                                    <h5 class="fw-bold mb-1">
                                                        {{ $booking->caregiver->user->name }}
                                                    </h5>

                                                    <span class="badge bg-secondary">
                                                        Completed
                                                    </span>

                                                </div>

                                                <div class="fw-bold text-muted">
                                                    {{ number_format($booking->price) }} EGP
                                                </div>

                                            </div>

                                            <div class="mb-2">
                                                <i class="bi bi-calendar-check text-success me-2"></i>

                                                {{ $booking->booking_date->format('F j, Y') }}
                                            </div>

                                            <div class="mb-3">
                                                <i class="bi bi-heart-pulse text-danger me-2"></i>

                                                {{ ucfirst($booking->booking_option) }}
                                            </div>

                                            <span class="badge bg-dark">
                                                Finished
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="text-center py-5">

                            <i class="bi bi-clock-history text-secondary"
                                style="font-size: 4rem;"></i>

                            <h4 class="mt-3 fw-bold">
                                No Booking History
                            </h4>

                            <p class="text-muted">
                                You do not have any past bookings yet.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</main>

</body>

@include('user.partials.footer')