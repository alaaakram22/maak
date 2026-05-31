<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use App\Models\caregivers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    /**
     * Store a newly created review in storage
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $customer = Auth::user();

        // Verify customer owns this booking
        if ($booking->customer_id !== $customer->id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        // Check if booking is in the past (completed)
        if ($booking->booking_date >= now()->startOfDay()) {
            return redirect()->back()->with('error', 'You can only review completed bookings');
        }

        // Check if review already exists for this booking
        if (Review::where('booking_id', $request->booking_id)->exists()) {
            return redirect()->back()->with('error', 'Review already exists for this booking');
        }

        Review::create([
            'booking_id' => $request->booking_id,
            'customer_id' => $customer->id,
            'caregiver_id' => $booking->caregiver_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('my.bookings')->with('success', 'Review created successfully');
    }

    /**
     * Get all reviews for a specific caregiver
     */
    public function getCaregiverReviews($caregiver_id)
    {
        $caregiver = caregivers::findOrFail($caregiver_id);
        $reviews = Review::where('caregiver_id', $caregiver_id)
            ->with('customer', 'booking')
            ->get();

        $averageRating = Review::where('caregiver_id', $caregiver_id)
            ->avg('rating');

        return response()->json([
            'caregiver' => $caregiver->load('user'),
            'average_rating' => round($averageRating, 1),
            'total_reviews' => count($reviews),
            'reviews' => $reviews,
        ]);
    }

    /**
     * Get average rating for a specific caregiver
     */
    public function getCaregiverAverageRating($caregiver_id)
    {
        $caregiver = caregivers::findOrFail($caregiver_id);

        $averageRating = Review::where('caregiver_id', $caregiver_id)
            ->avg('rating');

        $totalReviews = Review::where('caregiver_id', $caregiver_id)->count();

        return response()->json([
            'caregiver_id' => $caregiver_id,
            'average_rating' => $averageRating ? round($averageRating, 1) : 0,
            'total_reviews' => $totalReviews,
            'stars' => $this->formatStars($averageRating),
        ]);
    }

    /**
     * Get review for a specific booking
     */
    public function getBookingReview($booking_id)
    {
        $review = Review::where('booking_id', $booking_id)
            ->with('customer', 'caregiver')
            ->first();

        if (!$review) {
            return response()->json(['message' => 'No review found for this booking'], 404);
        }

        return response()->json($review);
    }

    /**
     * Update a review (only review text, rating is fixed)
     */
    public function update(Request $request, $review_id)
    {
        $review = Review::findOrFail($review_id);
        $customer = Auth::user();

        // Verify customer owns this review
        if ($review->customer_id !== $customer->id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $request->validate([
            'review' => 'nullable|string',
        ]);

        // Only update the review text, keep the rating unchanged
        $review->update([
            'review' => $request->review,
        ]);

        return redirect()->route('my.bookings')->with('success', 'Review updated successfully');
    }

    /**
     * Delete a review
     */
    public function destroy($review_id)
    {
        $review = Review::findOrFail($review_id);
        $customer = Auth::user();

        // Verify customer owns this review
        if ($review->customer_id !== $customer->id) {
            return redirect()->back()->with('error', 'Unauthorized');
        }

        $review->delete();

        return redirect()->route('my.bookings')->with('success', 'Review deleted successfully');
    }

    /**
     * Format stars as visual representation
     */
    private function formatStars($rating)
    {
        if (!$rating) {
            return '☆☆☆☆☆';
        }

        $full_stars = floor($rating);
        $half_star = ($rating - $full_stars) >= 0.5 ? 1 : 0;
        $empty_stars = 5 - $full_stars - $half_star;

        $stars = str_repeat('★', $full_stars);
        if ($half_star) {
            $stars .= '½';
        }
        $stars .= str_repeat('☆', $empty_stars);

        return $stars;
    }
}
