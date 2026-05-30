<?php

namespace App\Http\Controllers;
use App\Models\Booking;

use Illuminate\Http\Request;

class CaregiverBookingController extends Controller
{
    public function index()
    {
        $caregiverId = auth()->user()->caregiver->id;

        $bookings = Booking::where('caregiver_id', $caregiverId)
             ->where('status', '!=', 'pending')
            ->with('customer')
            ->orderBy('booking_date', 'desc')
            ->get();

        return view('Caregiver.caregiver_bookings', compact('bookings'));
    }

 
}