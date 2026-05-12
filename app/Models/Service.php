<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'price', 'duration', 'icon', 'image', 'is_active', 'category', 'rating', 'review_count'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
