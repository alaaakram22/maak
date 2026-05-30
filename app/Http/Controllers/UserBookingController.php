<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class UserBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('customer_id', auth()->id())
            ->where('status', '!=', 'pending')
            ->with('caregiver.user')
            ->orderBy('booking_date')
            ->get();

        return view('user.pages.my_bookings', compact('bookings'));
    }
}