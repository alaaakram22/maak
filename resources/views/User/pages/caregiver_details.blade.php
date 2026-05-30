@include('user.partials.header')
<body>
<main class="main pt-5">
    <div class="container py-5">

        <div class="row g-5 align-items-center">

            <!-- IMAGE -->
            <div class="col-lg-4 text-center">
                <img src="{{ $caregiver->image_url }}" class="img-fluid rounded shadow">
            </div>

            <!-- DETAILS -->
            <div class="col-lg-8">

                <h2 class="fw-bold">{{ $caregiver->user->name }}</h2>

                <!-- Rating -->
                <!-- <div class="mb-2 text-warning">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <=floor($caregiver->rating))
                        ⭐
                        @else
                        ☆
                        @endif
                        @endfor
                        ({{ number_format($caregiver->rating,1) ?? '0.0' }})
                </div> -->

                <p class="text-muted">{{ $caregiver->skills }}</p>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Experience:</strong> {{ $caregiver->experience }} years</p>
                        <p><strong>Gender:</strong> {{ $caregiver->user->gender }}</p>
                    </div>

                    <div class="col-md-6">
                        <p><strong>Phone:</strong> {{ $caregiver->user->phone }}</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- BOOKING FORM -->
        <div class="mt-5 p-4 shadow rounded bg-light">

            <h4 class="mb-4">Book Appointment</h4>
            <p class="text-muted">Choose one session, whole week, or whole month. After booking, you will be redirected to a payment page with the selected price.</p>
            @if ($errors->has('booking'))
                <div class="alert alert-danger">{{ $errors->first('booking') }}</div>
            @endif
            <form method="POST" action="{{ route('booking.store') }}">
                @csrf

                <input type="hidden" name="caregiver_id" value="{{ $caregiver->id }}">

                <div class="row">

                    <div class="col-md-6">
                        <label>Start Date</label>
                        <input type="date" name="booking_date" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Booking option</label>
                        <select name="booking_option" class="form-control" required>
                            <option value="">Select option</option>
                            <option value="session">One session — 800EGP</option>
                            <option value="week">Whole week — 5,200EGP</option>
                            <option value="month">Whole month — 21,000EGP</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button class="btn btn-primary px-4">
                        Confirm Booking
                    </button>
                </div>

            </form>

        </div>

    </div>
</main>
</body>
@include('user.partials.footer')