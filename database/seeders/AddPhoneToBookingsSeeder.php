<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class AddPhoneToBookingsSeeder extends Seeder
{
    public function run(): void
    {
        $phones = [
            '0300-1234567','0321-9876543','0333-4567890','0345-6543210',
            '0311-2345678','0322-8765432','0334-3456789','0346-7654321',
            '0312-5678901','0323-4321098','0335-6789012','0347-2109876',
            '0313-7890123','0324-5432109','0336-8901234','0348-3210987',
            '0314-9012345','0325-6543210','0337-0123456','0349-4321098',
        ];

        $bookings = Booking::whereNull('phone')->orWhere('phone','')->get();
        $count = 0;
        foreach ($bookings as $booking) {
            // Generate a valid 10-digit number
            $booking->phone = '03' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            $booking->save();
            $count++;
        }
        $this->command->info("Added phone to {$count} bookings.");
    }
}
