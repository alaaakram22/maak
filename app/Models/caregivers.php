<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class caregivers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'experience',
        'skills',
        'medical_background',
    ];
    protected $guarded = [];
    protected $casts = [
    'medical_background' => 'boolean',
];

    // ✅ relation to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getImageUrlAttribute()
{
    if ($this->image && file_exists(public_path('storage/' . $this->image))) {
        return asset('storage/' . $this->image);
    }

    return asset('images/default-caregiver.png');
}

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}