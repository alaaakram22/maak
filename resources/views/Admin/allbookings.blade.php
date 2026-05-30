@extends('admin.layouts.layout')

@section('body')

<div class="container-fluid py-4">

    <!-- TITLE -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="h3 fw-bold text-primary">
            All Bookings
        </h1>

    </div>

    <!-- CARD -->
    <div class="card shadow border-0 rounded-4">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead class="table-light">

                        <tr>
                            <th>Booking_Id</th>
                            <th>Customer</th>
                            <th>Caregiver</th>
                            <th>Date</th>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Created</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($bookings as $booking)

                            <tr>

                                <!-- ID -->
                                <td>
                                    {{ $booking->id }}
                                </td>

                                <!-- CUSTOMER -->
                                <td>

                                    <div class="fw-semibold">
                                        {{ $booking->customer->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $booking->customer->email }}
                                    </small>

                                </td>

                                <!-- CAREGIVER -->
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <img src="{{ $booking->caregiver->image_url }}"
                                             width="45"
                                             height="45"
                                             class="rounded-circle object-fit-cover">

                                        <div>

                                            <div class="fw-semibold">
                                                {{ $booking->caregiver->user->name }}
                                            </div>

                                            <small class="text-muted">
                                                {{ $booking->caregiver->skills }}
                                            </small>

                                        </div>

                                    </div>

                                </td>

                                <!-- DATE -->
                                <td>
                                    {{ $booking->booking_date }}
                                </td>

                                <!-- PLAN -->
                                <td>

                                    @if($booking->booking_option == 'session')

                                        <span class="badge bg-primary text-white">
                                            One Session
                                        </span>

                                    @elseif($booking->booking_option == 'week')

                                        <span class="badge bg-success text-white">
                                            Weekly
                                        </span>

                                    @else

                                        <span class="badge bg-dark text-white">
                                            Monthly
                                        </span>

                                    @endif

                                </td>

                                <!-- PRICE -->
                                <td class="fw-bold text-success">
                                    {{ number_format($booking->price) }} EGP
                                </td>

                                <!-- STATUS -->
                                <td>

                                    @if($booking->status == 'pending')

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @elseif($booking->status == 'confirmed')

                                        <span class="badge bg-success text-white">
                                            Accepted
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Cancelled
                                        </span>

                                    @endif

                                </td>

                                <!-- PAYMENT -->
                                <td>

                                    @if($booking->payment_status == 'paid')

                                        <span class="badge bg-success text-white">
                                            Paid
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @endif

                                </td>

                                <!-- CREATED -->
                                <td>
                                    {{ $booking->created_at->diffForHumans() }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center py-5 text-muted">

                                    No bookings found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection