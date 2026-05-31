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

                                                    <p class="mb-1 text-muted small">
                                                        {{ $booking->caregiver->skills ?? 'No skills listed' }}
                                                    </p>

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

                                                    <p class="mb-1 text-muted small">
                                                        {{ $booking->caregiver->skills ?? 'No skills listed' }}
                                                    </p>

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

                                            <!-- Caregiver Average Rating -->
                                            @php
                                                $avgRating = App\Models\Review::where('caregiver_id', $booking->caregiver_id)->avg('rating');
                                                $totalReviews = App\Models\Review::where('caregiver_id', $booking->caregiver_id)->count();
                                            @endphp
                                            
                                            @if($avgRating)
                                                <div class="mb-3">
                                                    <small class="text-muted">Caregiver Rating: </small>
                                                    <div class="d-flex align-items-center gap-2">
                                                        @php
                                                            $fullStars = floor($avgRating);
                                                            $halfStar = ($avgRating - $fullStars) >= 0.5 ? 1 : 0;
                                                            $emptyStars = 5 - $fullStars - $halfStar;
                                                        @endphp
                                                        <div>
                                                            @for($i = 0; $i < $fullStars; $i++)
                                                                <span class="text-warning">★</span>
                                                            @endfor
                                                            @if($halfStar)
                                                                <span class="text-warning">⭐</span>
                                                            @endif
                                                            @for($i = 0; $i < $emptyStars; $i++)
                                                                <span class="text-muted">☆</span>
                                                            @endfor
                                                        </div>
                                                        <small class="text-muted">({{ round($avgRating, 1) }} - {{ $totalReviews }} reviews)</small>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Check if review exists -->
                                            @php
                                                $review = App\Models\Review::where('booking_id', $booking->id)->first();
                                            @endphp

                                            <!-- Show Review if exists -->
                                            @if($review)
                                                <div class="mb-3 p-3 bg-white rounded-3 border-start border-warning border-3">
                                                    <div class="mb-2">
                                                        <strong>Your Rating:</strong>
                                                        <div>
                                                            @for($i = 0; $i < $review->rating; $i++)
                                                                <span class="text-warning">★</span>
                                                            @endfor
                                                            @for($i = $review->rating; $i < 5; $i++)
                                                                <span class="text-muted">☆</span>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    @if($review->review)
                                                        <div>
                                                            <strong>Your Review:</strong>
                                                            <p class="mb-0 text-muted" style="font-size: 0.9rem;">{{ $review->review }}</p>
                                                        </div>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                                                data-bs-toggle="modal" data-bs-target="#addReviewTextModal{{ $booking->id }}">
                                                            <i class="bi bi-pencil me-2"></i> Add Review
                                                        </button>
                                                    @endif
                                                    @if($review->review)
                                                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                                                data-bs-toggle="modal" data-bs-target="#addReviewTextModal{{ $booking->id }}">
                                                            <i class="bi bi-pencil me-2"></i> Edit Review
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                <!-- Add Review Button -->
                                                <button type="button" class="btn btn-sm btn-primary w-100" 
                                                        data-bs-toggle="modal" data-bs-target="#reviewModal{{ $booking->id }}">
                                                    <i class="bi bi-star me-2"></i> Rate & Review
                                                </button>
                                            @endif

                                            <span class="badge bg-dark">
                                                Finished
                                            </span>

                                        </div>

                                    </div>

                                </div>

                                <!-- Review Modal -->
                                @if(!$review)
                                    <div class="modal fade" id="reviewModal{{ $booking->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $booking->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="reviewModalLabel{{ $booking->id }}">
                                                        Rate & Review {{ $booking->caregiver->user->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('reviews.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                    <div class="modal-body">
                                                        <!-- Star Rating -->
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Rating *</label>
                                                            <div class="rating-input d-flex gap-2" style="font-size: 2rem;">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <input type="radio" name="rating" value="{{ $i }}" id="star{{ $i }}_{{ $booking->id }}" class="d-none">
                                                                    <label for="star{{ $i }}_{{ $booking->id }}" class="cursor-pointer" style="cursor: pointer;">
                                                                        <span class="star-icon text-muted" data-value="{{ $i }}">★</span>
                                                                    </label>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <!-- Review Text -->
                                                        <div class="mb-3">
                                                            <label for="review{{ $booking->id }}" class="form-label fw-bold">Review (Optional)</label>
                                                            <textarea class="form-control" id="review{{ $booking->id }}" name="review" rows="4" placeholder="Share your experience with this caregiver..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Submit Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Add/Edit Review Text Modal -->
                                @if($review)
                                    <div class="modal fade" id="addReviewTextModal{{ $booking->id }}" tabindex="-1" aria-labelledby="addReviewTextModalLabel{{ $booking->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addReviewTextModalLabel{{ $booking->id }}">
                                                        {{ $review->review ? 'Edit' : 'Add' }} Your Review
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <!-- Review Text -->
                                                        <div class="mb-3">
                                                            <label for="reviewText{{ $booking->id }}" class="form-label fw-bold">Review</label>
                                                            <textarea class="form-control" id="reviewText{{ $booking->id }}" name="review" rows="4" placeholder="Share your experience with this caregiver...">{{ $review->review }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

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

<script>
    // Interactive star rating
    document.querySelectorAll('.rating-input').forEach(ratingDiv => {
        const labels = ratingDiv.querySelectorAll('label');
        const radios = ratingDiv.querySelectorAll('input[type="radio"]');
        
        labels.forEach(label => {
            label.addEventListener('mouseover', function() {
                const value = this.querySelector('.star-icon').getAttribute('data-value');
                updateStarsYellow(ratingDiv, value);
            });
        });
        
        ratingDiv.addEventListener('mouseleave', function() {
            const checked = ratingDiv.querySelector('input[type="radio"]:checked');
            if (checked) {
                updateStarsYellow(ratingDiv, checked.value);
            } else {
                resetStars(ratingDiv);
            }
        });
        
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                updateStarsYellow(ratingDiv, this.value);
            });
        });
        
        // Set initial state if value is checked
        const checked = ratingDiv.querySelector('input[type="radio"]:checked');
        if (checked) {
            updateStarsYellow(ratingDiv, checked.value);
        }
    });
    
    function updateStarsYellow(ratingDiv, value) {
        const stars = ratingDiv.querySelectorAll('.star-icon');
        stars.forEach(star => {
            const starValue = star.getAttribute('data-value');
            if (starValue <= value) {
                star.style.color = '#FFC107';
                star.textContent = '★';
            } else {
                star.style.color = '#DDD';
                star.textContent = '★';
            }
        });
    }
    
    function resetStars(ratingDiv) {
        const stars = ratingDiv.querySelectorAll('.star-icon');
        stars.forEach(star => {
            star.style.color = '#DDD';
            star.textContent = '★';
        });
    }
</script>

</body>

@include('user.partials.footer')