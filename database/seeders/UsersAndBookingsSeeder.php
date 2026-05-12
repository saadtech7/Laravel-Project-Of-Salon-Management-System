<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;

class UsersAndBookingsSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'James Carter',   'email' => 'james.carter@example.com'],
            ['name' => 'Sophia Williams','email' => 'sophia.williams@example.com'],
            ['name' => 'Liam Johnson',   'email' => 'liam.johnson@example.com'],
            ['name' => 'Olivia Brown',   'email' => 'olivia.brown@example.com'],
            ['name' => 'Noah Davis',     'email' => 'noah.davis@example.com'],
            ['name' => 'Emma Wilson',    'email' => 'emma.wilson@example.com'],
            ['name' => 'Ethan Martinez', 'email' => 'ethan.martinez@example.com'],
            ['name' => 'Ava Anderson',   'email' => 'ava.anderson@example.com'],
            ['name' => 'Mason Thomas',   'email' => 'mason.thomas@example.com'],
            ['name' => 'Isabella Taylor','email' => 'isabella.taylor@example.com'],
        ];

        $createdUsers = [];
        foreach ($users as $u) {
            $createdUsers[] = User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name'     => $u['name'],
                    'password' => Hash::make('password123'),
                    'role'     => 'user',
                ]
            );
        }

        $serviceIds = Service::pluck('id')->toArray();
        if (empty($serviceIds)) {
            $this->command->warn('No services found. Run ServiceSeeder first.');
            return;
        }

        $addresses = [
            '12 Oak Street, New York, NY 10001',
            '45 Maple Ave, Los Angeles, CA 90001',
            '78 Pine Road, Chicago, IL 60601',
            '23 Elm Blvd, Houston, TX 77001',
            '90 Cedar Lane, Phoenix, AZ 85001',
            '56 Birch Court, Philadelphia, PA 19101',
            '34 Walnut Dr, San Antonio, TX 78201',
            '67 Spruce Way, San Diego, CA 92101',
            '11 Willow St, Dallas, TX 75201',
            '88 Ash Avenue, San Jose, CA 95101',
        ];

        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];
        $times    = ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'];
        $notes    = [
            'Please bring premium products.',
            'First time customer, be gentle.',
            'Allergic to certain hair dyes.',
            'Prefer a female professional.',
            'Running 5 minutes late possibly.',
            null, null, null, null, null,
        ];

        foreach ($createdUsers as $i => $user) {
            $daysOffset = rand(-30, 30);
            $date = now()->addDays($daysOffset)->format('Y-m-d');

            Booking::create([
                'user_id'      => $user->id,
                'service_id'   => $serviceIds[array_rand($serviceIds)],
                'booking_date' => $date,
                'booking_time' => $times[array_rand($times)],
                'status'       => $statuses[array_rand($statuses)],
                'address'      => $addresses[$i],
                'notes'        => $notes[array_rand($notes)],
            ]);
        }

        $this->command->info('✅ 10 users and 10 bookings seeded successfully.');
    }
}
