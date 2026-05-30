@include('user.partials.header')
<body>
<main class="main pt-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white shadow rounded p-5">
                    <h2 class="mb-4">Payment</h2>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('info'))
                        <div class="alert alert-info">{{ session('info') }}</div>
                    @endif

                    <div class="mb-4">
                        <p><strong>Caregiver:</strong> {{ $booking->caregiver->user->name }}</p>
                        <p><strong>Date:</strong> {{ $booking->booking_date->format('F j, Y') }}</p>
                        <p><strong>Booking option:</strong> {{ ucfirst($booking->booking_option) }}</p>
                        <p><strong>Price:</strong> {{ number_format($booking->price) }} EGP</p>
                        <p class="text-muted">This is a payment page. No actual payment will be processed.</p>
                    </div>

                    @if ($booking->payment_status === 'paid')
                        <div class="alert alert-info">
                            Your booking has already been confirmed.
                        </div>
                    @else
                        <form method="POST" action="{{ route('booking.pay', $booking) }}">
                            @csrf

                                     <div class="mb-3">
                                <label class="form-label">Card Holder Name</label>

                                <input
                                    type="text"
                                    name="card_name"
                                    class="form-control"
                                    placeholder="John Doe"
                                    required
                                >
                            </div>

                            {{-- Card Number --}}
                            <div class="mb-3">
                                <label class="form-label">Card Number</label>

                                <input
                                    type="text"
                                    name="card_number"
                                    class="form-control"
                                    placeholder="12345678901234"
                                    maxlength="14"
                                    pattern="\d{14}"
                                    title="Card number must be exactly 14 digits"
                                    required
                                >
                            </div>

                            <div class="row">

                                {{-- Expiry Month --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Month</label>

                                    <input
                                        type="text"
                                        name="expiry_month"
                                        class="form-control"
                                        placeholder="MM"
                                        maxlength="2"
                                        pattern="\d{2}"
                                        title="Month must be 2 digits"
                                        required
                                    >
                                </div>

                                {{-- Expiry Year --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year</label>

                                    <input
                                        type="text"
                                        name="expiry_year"
                                        class="form-control"
                                        placeholder="YY"
                                        maxlength="2"
                                        pattern="\d{2}"
                                        title="Year must be 2 digits"
                                        required
                                    >
                                </div>

                                {{-- CVV --}}
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">CVV</label>

                                    <input
                                        type="password"
                                        name="cvv"
                                        class="form-control"
                                        placeholder="123"
                                        maxlength="3"
                                        pattern="\d{3}"
                                        title="CVV must be exactly 3 digits"
                                        required
                                    >
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary btn-lg">Pay {{ number_format($booking->price) }} EGP (Pay)</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
</body>
@include('user.partials.footer')
