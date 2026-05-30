@include('user.partials.header')

<body>

    <main class="main pt-5 bg-light min-vh-100">

        <div class="container py-5">

            <div class="bg-white shadow rounded-4 p-4">

                <!-- HEADER -->
                <div class="mb-4">
                    <h2 class="fw-bold mb-1">Caregiver Bookings</h2>

                    <p class="text-muted mb-0">
                        Manage your upcoming and past client bookings
                    </p>
                </div>

                <!-- SUCCESS MESSAGE -->
                @if(session('success'))
                    <div class="alert alert-success rounded-3">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- VALIDATION ERRORS -->
                @if($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- TABS -->
                <ul class="nav nav-pills mb-4">

                    <li class="nav-item me-2">
                        <button class="nav-link active px-4 py-2"
                            data-bs-toggle="pill"
                            data-bs-target="#upcoming">

                            Upcoming Requests

                        </button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link px-4 py-2"
                            data-bs-toggle="pill"
                            data-bs-target="#history">

                            Past Work

                        </button>
                    </li>

                </ul>

                <div class="tab-content">

                    <!-- UPCOMING -->
                    <div class="tab-pane fade show active" id="upcoming">

                        @php
                            $upcomingBookings = $bookings->filter(
                                fn($b) => $b->booking_date >= now()->startOfDay()
                            );
                        @endphp

                        @if($upcomingBookings->count())

                            <div class="row g-4">

                                @foreach($upcomingBookings as $booking)

                                    <div class="col-md-6">

                                        <div class="card border-0 shadow-sm rounded-4 h-100">

                                            <div class="card-body p-4">

                                                <!-- HEADER -->
                                                <div class="d-flex justify-content-between align-items-start">

                                                    <div>

                                                        <h5 class="fw-bold mb-1">
                                                            Customer Name:
                                                            {{ $booking->customer->name }}
                                                        </h5>

                                                        <p class="text-muted small mb-2">
                                                            {{ $booking->customer->email }}
                                                        </p>

                                                    </div>

                                                    <span class="badge bg-primary">
                                                        Upcoming
                                                    </span>

                                                </div>

                                                <hr>

                                                <!-- CUSTOMER INFO -->
                                                <div class="small text-muted mb-3">

                                                    <div class="mb-1">
                                                        <i class="bi bi-telephone me-1"></i>
                                                        {{ $booking->customer->phone ?? 'N/A' }}
                                                    </div>

                                                    <div class="mb-1">
                                                        <i class="bi bi-gender-ambiguous me-1"></i>
                                                        {{ $booking->customer->gender ?? 'N/A' }}
                                                    </div>

                                                    <div class="mb-1">
                                                        <i class="bi bi-cake me-1"></i>
                                                        {{ $booking->customer->date_of_birth ?? 'N/A' }}
                                                    </div>

                                                </div>

                                                <!-- EXTRA INFO -->
                                                <div class="small text-muted mb-3">

                                                    <div class="mb-2">
                                                        <strong>Address:</strong><br>

                                                        {{ $booking->customer->customer->address ?? 'Not provided' }}
                                                    </div>

                                                    <div>
                                                        <strong>Medical History:</strong><br>

                                                        {{ $booking->customer->customer->medical_history ?? 'No medical history' }}
                                                    </div>

                                                </div>

                                                <hr>

                                                <!-- BOOKING INFO -->
                                                <div class="d-flex justify-content-between align-items-center">

                                                    <div>

                                                        <div class="mb-1">
                                                            <i class="bi bi-calendar-event text-primary me-2"></i>

                                                            {{ $booking->booking_date->format('F j, Y') }}
                                                        </div>

                                                        <div>
                                                            <i class="bi bi-heart-pulse text-danger me-2"></i>

                                                            {{ ucfirst($booking->booking_option) }}
                                                        </div>

                                                    </div>

                                                    <div class="text-end">

                                                        <div class="fw-bold text-success">
                                                            {{ number_format($booking->price * 0.6) }} EGP
                                                        </div>

                                                        @if($booking->status === 'confirmed')

                                                            <span class="badge bg-success">
                                                                Confirmed
                                                            </span>

                                                        @elseif($booking->status === 'pending')

                                                            <span class="badge bg-warning text-dark">
                                                                Pending
                                                            </span>

                                                        @else

                                                            <span class="badge bg-secondary">
                                                                {{ ucfirst($booking->status) }}
                                                            </span>

                                                        @endif

                                                    </div>

                                                </div>

                                                <!-- HEALTH STATUS -->
                                                <div class="mt-4">

                                                    <label class="form-label fw-semibold mb-2">
                                                        Customer Status:
                                                    </label>

                                                    <br>

                                                    @if($booking->customer->customer->health_status == 'normal')

                                                        <span class="badge bg-success">
                                                            Normal
                                                        </span>

                                                    @elseif($booking->customer->customer->health_status == 'moderate')

                                                        <span class="badge bg-warning text-dark">
                                                            Moderate
                                                        </span>

                                                    @elseif($booking->customer->customer->health_status == 'critical')

                                                        <span class="badge bg-danger">
                                                            Critical
                                                        </span>

                                                    @endif

                                                </div>

                                                <!-- NOTES -->
                                                @if($booking->customer->customer->health_notes)

                                                    <div class="mt-3">

                                                        <strong>Caregiver Notes:</strong>

                                                        <div class="small text-muted mt-1">
                                                            {{ $booking->customer->customer->health_notes }}
                                                        </div>

                                                    </div>

                                                @endif

                                                <!-- UPDATE FORM -->
                                                <div class="mt-4">

                                                    <hr>

                                                    <h6 class="fw-bold mb-3">
                                                        Customer Health Update
                                                    </h6>

                                                    <form action="{{ route('caregiver.booking.updateStatus', $booking->id) }}"
                                                        method="POST">

                                                        @csrf

                                                        <!-- STATUS -->
                                                        <div class="mb-3">

                                                            <label class="form-label fw-semibold">
                                                                Customer Status
                                                            </label>

                                                            <select name="health_status"
                                                                class="form-select rounded-3">

                                                                <option value="normal"
                                                                    {{ $booking->customer->customer->health_status == 'normal' ? 'selected' : '' }}>

                                                                    Normal

                                                                </option>

                                                                <option value="moderate"
                                                                    {{ $booking->customer->customer->health_status == 'moderate' ? 'selected' : '' }}>

                                                                    Moderate

                                                                </option>

                                                                <option value="critical"
                                                                    {{ $booking->customer->customer->health_status == 'critical' ? 'selected' : '' }}>

                                                                    Critical

                                                                </option>

                                                            </select>

                                                        </div>

                                                        <!-- NOTES -->
                                                        <div class="mb-3">

                                                            <label class="form-label fw-semibold">
                                                                Customer Notes
                                                            </label>

                                                            <textarea name="health_notes"
                                                                rows="4"
                                                                class="form-control rounded-3"
                                                                placeholder="Write notes about the customer...">{{ $booking->customer->customer->health_notes }}</textarea>

                                                        </div>

                                                        <button type="submit"
                                                            class="btn btn-primary rounded-3 w-100">

                                                            Save Update

                                                        </button>

                                                    </form>

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
                                    You currently have no incoming requests.
                                </p>

                            </div>

                        @endif

                    </div>

                    <!-- HISTORY -->
                    <div class="tab-pane fade" id="history">

                        @php
                            $pastBookings = $bookings->filter(
                                fn($b) => $b->booking_date < now()->startOfDay()
                            );
                        @endphp

                        @if($pastBookings->count())

                            <div class="row g-4">

                                @foreach($pastBookings as $booking)

                                    <div class="col-md-6">

                                        <div class="card border-0 shadow-sm rounded-4 h-100 bg-light">

                                            <div class="card-body p-4">

                                                <h5 class="fw-bold mb-1">
                                                    {{ $booking->customer->name }}
                                                </h5>

                                                <p class="text-muted small mb-3">
                                                    {{ $booking->customer->email }}
                                                </p>

                                                <div class="mb-2">

                                                    <i class="bi bi-calendar-check text-success me-2"></i>

                                                    {{ $booking->booking_date->format('F j, Y') }}

                                                </div>

                                                <div class="mb-3">

                                                    <i class="bi bi-heart-pulse text-danger me-2"></i>

                                                    {{ ucfirst($booking->booking_option) }}

                                                </div>

                                                <!-- STATUS -->
                                                <div class="mb-3">

                                                    <label class="form-label fw-semibold mb-2">
                                                        Customer Status:
                                                    </label>

                                                    <br>

                                                    @if($booking->customer->customer->health_status == 'normal')

                                                        <span class="badge bg-success">
                                                            Normal
                                                        </span>

                                                    @elseif($booking->customer->customer->health_status == 'moderate')

                                                        <span class="badge bg-warning text-dark">
                                                            Moderate
                                                        </span>

                                                    @elseif($booking->customer->customer->health_status == 'critical')

                                                        <span class="badge bg-danger">
                                                            Critical
                                                        </span>

                                                    @endif

                                                </div>

                                                <!-- NOTES -->
                                                @if($booking->customer->customer->health_notes)

                                                    <div class="small text-muted mb-3">

                                                        <strong>Caregiver Notes:</strong><br>

                                                        {{ $booking->customer->customer->health_notes }}

                                                    </div>

                                                @endif

                                                <span class="badge bg-dark">
                                                    Completed
                                                </span>

                                                <!-- UPDATE FORM -->
                                                <div class="mt-4">

                                                    <hr>

                                                    <h6 class="fw-bold mb-3">
                                                        Update Customer Health
                                                    </h6>

                                                    <form action="{{ route('caregiver.booking.updateStatus', $booking->id) }}"
                                                        method="POST">

                                                        @csrf

                                                        <!-- STATUS -->
                                                        <div class="mb-3">

                                                            <label class="form-label fw-semibold">
                                                                Customer Status
                                                            </label>

                                                            <select name="health_status"
                                                                class="form-select rounded-3">

                                                                <option value="normal"
                                                                    {{ $booking->customer->customer->health_status == 'normal' ? 'selected' : '' }}>

                                                                    Normal

                                                                </option>

                                                                <option value="moderate"
                                                                    {{ $booking->customer->customer->health_status == 'moderate' ? 'selected' : '' }}>

                                                                    Moderate

                                                                </option>

                                                                <option value="critical"
                                                                    {{ $booking->customer->customer->health_status == 'critical' ? 'selected' : '' }}>

                                                                    Critical

                                                                </option>

                                                            </select>

                                                        </div>

                                                        <!-- NOTES -->
                                                        <div class="mb-3">

                                                            <label class="form-label fw-semibold">
                                                                Customer Notes
                                                            </label>

                                                            <textarea name="health_notes"
                                                                rows="4"
                                                                class="form-control rounded-3"
                                                                placeholder="Write notes about the customer...">{{ $booking->customer->customer->health_notes }}</textarea>

                                                        </div>

                                                        <button type="submit"
                                                            class="btn btn-dark rounded-3 w-100">

                                                            Update Previous Work

                                                        </button>

                                                    </form>

                                                </div>

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
                                    No Past Work
                                </h4>

                                <p class="text-muted">
                                    You haven't completed any bookings yet.
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