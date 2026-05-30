@include('user.partials.header')

<body class="bg-light">

    <main class="main pt-5" style="margin-top:120px;">

        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <!-- CARD -->
                    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                        <!-- HEADER -->
                        <div class="bg-primary text-white p-4">
                            <h3 class="mb-1 fw-bold">Secure Payment</h3>
                            <p class="mb-0 opacity-100">Complete your booking payment safely</p>


                        </div>
                        <div class="alert alert-warning border-0 rounded-3 mb-4 shadow-sm">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-exclamation-triangle-fill me-2 fs-5 text-warning"></i>

                                <div>
                                    <strong>Important Notice</strong>
                                    <p class="mb-0 small text-muted">
                                        Any cancellation after completing this payment will require contacting our
                                        support team.
                                        Refunds or modifications are not available directly through the system.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-5">

                            {{-- SUCCESS / INFO --}}
                            @if(session('success'))
                            <div class="alert alert-success rounded-3">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if(session('info'))
                            <div class="alert alert-info rounded-3">
                                {{ session('info') }}
                            </div>
                            @endif

                            {{-- BOOKING SUMMARY --}}
                            <div class="bg-light rounded-4 p-4 mb-4">

                                <h5 class="fw-bold mb-3">Booking Summary</h5>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Caregiver</span>
                                    <span class="fw-semibold">{{ $booking->caregiver->user->name }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Date</span>
                                    <span class="fw-semibold">
                                        {{ $booking->booking_date->format('F j, Y') }}
                                    </span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Plan</span>
                                    <span class="fw-semibold text-primary">
                                        @if($booking->booking_option == 'session')
                                        One Session
                                        @elseif($booking->booking_option == 'week')
                                        Weekly Plan
                                        @else
                                        Monthly Plan
                                        @endif
                                    </span>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold">Total</span>
                                    <span class="fw-bold text-success fs-5">
                                        {{ number_format($booking->price) }} EGP
                                    </span>
                                </div>

                            </div>

                            {{-- ALREADY PAID --}}
                            @if($booking->payment_status === 'paid')

                            <div class="alert alert-success text-center rounded-3">
                                ✔ Payment completed. Your booking is confirmed. You will receive a confirmation email
                                shortly. and a Caregiver will contact you soon.
                            </div>

                            @else

                            {{-- PAYMENT FORM --}}
                            <form method="POST" action="{{ route('booking.pay', $booking) }}">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Card Holder Name</label>
                                    <input type="text" name="card_name" class="form-control rounded-3" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Card Number</label>
                                    <input type="text" name="card_number" class="form-control rounded-3" maxlength="16"
                                        pattern="\d{16}" placeholder="1234 5678 9012 3456" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">MM</label>
                                        <input type="text" name="expiry_month" class="form-control rounded-3"
                                            maxlength="2" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">YY</label>
                                        <input type="text" name="expiry_year" class="form-control rounded-3"
                                            maxlength="2" required>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">CVV</label>
                                        <input type="password" name="cvv" class="form-control rounded-3" maxlength="3"
                                            required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3">
                                    Pay {{ number_format($booking->price) }} EGP
                                </button>

                            </form>

                            @endif

                        </div>
                    </div>

                </div>
            </div>

        </div>

    </main>

</body>

@include('user.partials.footer')