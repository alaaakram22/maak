<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\caregivers;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'caregiver_id',
        'booking_date',
        'booking_option',
        'price',
        'status',
        'payment_status',
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function caregiver()
    {
        return $this->belongsTo(caregivers::class, 'caregiver_id');
    }
}
