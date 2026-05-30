<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\caregivers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'caregiver_id' => ['required', 'exists:caregivers,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'booking_option' => ['required', 'in:session,week,month'],
        ]);

        $user = $request->user();
        if (! $user || $user->role !== 'customer') {
            abort(403, 'Only customers can make bookings.');
        }

        $caregiver = caregivers::findOrFail($request->caregiver_id);

        $priceMap = [
            'session' => 800,
            'week' => 5200,
            'month' => 21000,
        ];

        $requestedDate = Carbon::parse($request->booking_date);
        $requestedEndDate = $this->bookingEndDate($requestedDate, $request->booking_option);

        $conflictingBooking = Booking::where('status', 'confirmed')
            ->where(function ($query) use ($user, $caregiver) {
                $query->where('customer_id', $user->id)
                    ->orWhere('caregiver_id', $caregiver->id);
            })
            ->get()
            ->first(function (Booking $existing) use ($requestedDate, $requestedEndDate) {
                $existingStart = $existing->booking_date;
                $existingEnd = $this->bookingEndDate($existingStart, $existing->booking_option);

                return $this->rangesOverlap($requestedDate, $requestedEndDate, $existingStart, $existingEnd);
            });

        if ($conflictingBooking) {
            return back()
                ->withErrors(['booking' => 'A confirmed booking already exists for this customer or caregiver during the selected period.'])
                ->withInput();
        }

        $booking = Booking::create([
            'customer_id' => $user->id,
            'caregiver_id' => $caregiver->id,
            'booking_date' => $request->booking_date,
            'booking_option' => $request->booking_option,
            'price' => $priceMap[$request->booking_option],
            'status' => 'pending',
            'payment_status' => 'pending',
        ]);

        return redirect()->route('booking.payment', $booking);
    }

    public function payment(Booking $booking)
    {
        $user = auth()->user();
        if (! $user || $user->id !== $booking->customer_id) {
            abort(403);
        }

        return view('User.pages.booking_payment', compact('booking'));
    }

    public function pay(Request $request, Booking $booking)
    {
        $user = auth()->user();
        if (! $user || $user->id !== $booking->customer_id) {
            abort(403);
        }

        if ($booking->payment_status === 'paid') {
            return redirect()->route('booking.payment', $booking)
                ->with('info', 'This booking has already been paid and confirmed.');
        }

        $booking->update([
            'payment_status' => 'paid',
            'status' => 'confirmed',
        ]);

        return redirect()->route('booking.payment', $booking)
            ->with('success', 'Payment completed successfully. Your booking is confirmed.');
    }

    private function bookingEndDate(Carbon $startDate, string $option): Carbon
    {
        return match ($option) {
            'week' => $startDate->copy()->addDays(6),
            'month' => $startDate->copy()->addDays(29),
            default => $startDate->copy(),
        };
    }

    private function rangesOverlap(Carbon $startA, Carbon $endA, Carbon $startB, Carbon $endB): bool
    {
        return $startA->lte($endB) && $startB->lte($endA);
    }
}
