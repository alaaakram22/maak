<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'medical_history',
        'address',
        'health_status',
        'health_notes',
    ];
    protected $guarded = [];

    // ✅ relation to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}