<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use Carbon\Carbon;

class FixBookingStatusSeeder extends Seeder
{
    public function run(): void
    {
        $bookings = Booking::all();
        $fixed = 0;

        foreach ($bookings as $booking) {
            $date = Carbon::parse($booking->booking_date);

            if ($date->isFuture() || $date->isToday()) {
                // Future/today: must be pending or confirmed only
                if ($booking->status === 'completed') {
                    $booking->status = rand(0, 1) ? 'pending' : 'confirmed';
                    $booking->save();
                    $fixed++;
                }
            } else {
                // Past: must be completed or cancelled
                if (in_array($booking->status, ['pending', 'confirmed'])) {
                    $booking->status = rand(0, 3) === 0 ? 'cancelled' : 'completed';
                    $booking->save();
                    $fixed++;
                }
            }
        }

        $this->command->info("Fixed {$fixed} bookings out of {$bookings->count()} total.");
    }
}
