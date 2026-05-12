<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Post;
use App\Models\Contact;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // ── 20 Users ──────────────────────────────────────────────
        $userData = [
            ['name' => 'James Carter',      'email' => 'james.carter@example.com'],
            ['name' => 'Sophia Williams',   'email' => 'sophia.williams@example.com'],
            ['name' => 'Liam Johnson',      'email' => 'liam.johnson@example.com'],
            ['name' => 'Olivia Brown',      'email' => 'olivia.brown@example.com'],
            ['name' => 'Noah Davis',        'email' => 'noah.davis@example.com'],
            ['name' => 'Emma Wilson',       'email' => 'emma.wilson@example.com'],
            ['name' => 'Ethan Martinez',    'email' => 'ethan.martinez@example.com'],
            ['name' => 'Ava Anderson',      'email' => 'ava.anderson@example.com'],
            ['name' => 'Mason Thomas',      'email' => 'mason.thomas@example.com'],
            ['name' => 'Isabella Taylor',   'email' => 'isabella.taylor@example.com'],
            ['name' => 'Logan Jackson',     'email' => 'logan.jackson@example.com'],
            ['name' => 'Mia White',         'email' => 'mia.white@example.com'],
            ['name' => 'Lucas Harris',      'email' => 'lucas.harris@example.com'],
            ['name' => 'Charlotte Martin',  'email' => 'charlotte.martin@example.com'],
            ['name' => 'Aiden Garcia',      'email' => 'aiden.garcia@example.com'],
            ['name' => 'Amelia Lee',        'email' => 'amelia.lee@example.com'],
            ['name' => 'Jackson Thompson',  'email' => 'jackson.thompson@example.com'],
            ['name' => 'Harper Moore',      'email' => 'harper.moore@example.com'],
            ['name' => 'Sebastian Clark',   'email' => 'sebastian.clark@example.com'],
            ['name' => 'Evelyn Lewis',      'email' => 'evelyn.lewis@example.com'],
        ];

        $users = [];
        foreach ($userData as $u) {
            $users[] = User::firstOrCreate(
                ['email' => $u['email']],
                ['name' => $u['name'], 'password' => Hash::make('password123'), 'role' => 'user']
            );
        }

        // ── 20 Bookings ───────────────────────────────────────────
        $serviceIds = Service::pluck('id')->toArray();
        $statuses   = ['pending', 'pending', 'confirmed', 'confirmed', 'completed', 'cancelled'];
        $times      = ['09:00','09:30','10:00','10:30','11:00','11:30','12:00','13:00','14:00','15:00','16:00','16:30'];
        $addresses  = [
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
            '22 Rosewood Dr, Austin, TX 73301',
            '15 Magnolia Blvd, Seattle, WA 98101',
            '99 Cypress Lane, Denver, CO 80201',
            '44 Poplar St, Boston, MA 02101',
            '77 Hickory Ave, Nashville, TN 37201',
            '33 Juniper Rd, Portland, OR 97201',
            '55 Sycamore Ct, Las Vegas, NV 89101',
            '18 Chestnut Way, Miami, FL 33101',
            '62 Redwood Blvd, Atlanta, GA 30301',
            '29 Birchwood Dr, Minneapolis, MN 55401',
        ];
        $notes = [
            'Please bring premium products.',
            'First time customer, be gentle.',
            'Allergic to certain hair dyes.',
            'Prefer a female professional.',
            null, null, null, null, null, null,
        ];

        if (!empty($serviceIds)) {
            foreach ($users as $i => $user) {
                $daysOffset = rand(-45, 45);
                $bookingDate = now()->addDays($daysOffset);

                // Assign status based on date logic
                if ($daysOffset > 0) {
                    // Future: only pending or confirmed
                    $status = rand(0, 1) ? 'pending' : 'confirmed';
                } elseif ($daysOffset === 0) {
                    // Today: pending or confirmed
                    $status = rand(0, 1) ? 'pending' : 'confirmed';
                } else {
                    // Past: completed or cancelled
                    $status = rand(0, 3) === 0 ? 'cancelled' : 'completed';
                }

                Booking::create([
                    'user_id'      => $user->id,
                    'service_id'   => $serviceIds[array_rand($serviceIds)],
                    'booking_date' => $bookingDate->format('Y-m-d'),
                    'booking_time' => $times[array_rand($times)],
                    'status'       => $status,
                    'address'      => $addresses[$i],
                    'notes'        => $notes[array_rand($notes)],
                ]);
            }
        }

        // ── 10 Posts (by admin) ───────────────────────────────────
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $posts = [
                ['title' => 'Welcome to Salon Prime — Your Premium Grooming Destination',
                 'content' => "We're thrilled to launch Salon Prime, your go-to destination for professional grooming services delivered right to your doorstep.\n\nOur team of verified, experienced professionals is dedicated to giving you the best haircut, beard styling, facial, and more — all from the comfort of your home.\n\nBook your first appointment today and experience the difference. Use code PRIME5 for \$5 off your first booking!"],

                ['title' => 'Top 5 Haircut Trends for Men in 2026',
                 'content' => "Staying on top of the latest trends is key to looking sharp. Here are the top 5 men's haircut trends dominating 2026:\n\n1. Textured Crop — Clean on the sides, textured on top.\n2. Modern Pompadour — A timeless classic with a contemporary twist.\n3. Buzz Cut Fade — Minimal maintenance, maximum style.\n4. Curtain Bangs — Making a strong comeback this year.\n5. Slick Back Undercut — Bold, confident, and always in style.\n\nBook a session with our expert barbers to get any of these looks today!"],

                ['title' => 'Why At-Home Salon Services Are the Future of Grooming',
                 'content' => "The grooming industry has shifted dramatically. More and more people are choosing at-home salon services over traditional barbershops.\n\nConvenience — No commute, no waiting. Your barber comes to you.\nSafety — One-on-one service in your own space.\nPersonalization — Your barber focuses entirely on you.\nTime-saving — Get groomed during your lunch break or after work.\n\nAt Salon Prime, we bring the full salon experience to your door."],

                ['title' => 'How to Maintain Your Beard Between Appointments',
                 'content' => "A great beard doesn't maintain itself. Here are our top tips to keep your beard looking sharp between professional trims:\n\n- Wash regularly with a beard shampoo 2-3 times a week.\n- Moisturize daily with beard oil.\n- Comb it out to prevent tangles.\n- Trim the edges with a trimmer.\n- Eat a protein-rich diet for healthy beard growth.\n\nBook a beard trim with us every 2-3 weeks for the best results."],

                ['title' => "Introducing Women's Services at Salon Prime",
                 'content' => "We're excited to announce the launch of our full range of women's grooming and beauty services!\n\nFrom precision haircuts and blowouts to hair spa treatments, waxing, facials, and manicures — our certified female professionals are here to pamper you.\n\nAll services are performed at your home with premium, salon-grade products. Explore our women's services and book your first appointment today!"],

                ['title' => 'The Benefits of a Professional Facial Cleanup',
                 'content' => "A facial cleanup is one of the most underrated grooming treatments. Here's why you should book one:\n\nDeep pore cleansing — Removes dirt, oil, and dead skin cells.\nBrightening effect — Instantly improves skin tone and texture.\nAnti-aging — Regular cleanups slow down fine lines.\nRelaxation — The massage component relieves facial tension.\n\nOur professionals use dermatologist-approved products suited to your skin type."],

                ['title' => "Salon Prime's Hygiene & Safety Standards",
                 'content' => "Your safety is our top priority. Here's how we ensure every service meets the highest hygiene standards:\n\n- All tools are sterilized before and after every appointment.\n- Professionals wear gloves and masks during services.\n- Single-use items are never reused.\n- All professionals undergo regular health checks.\n- Products used are certified and allergen-tested."],

                ['title' => 'Customer Spotlight: Real Stories from Our Clients',
                 'content' => "Nothing makes us prouder than hearing from our happy customers. Here are a few recent reviews:\n\n⭐⭐⭐⭐⭐ \"Best haircut I've ever had. The barber was on time, professional, and the result was exactly what I wanted.\" — James C.\n\n⭐⭐⭐⭐⭐ \"The hair spa treatment was absolutely amazing. My hair feels so soft and healthy.\" — Sophia W.\n\n⭐⭐⭐⭐⭐ \"I was skeptical about at-home services but Salon Prime completely changed my mind.\" — Noah D."],

                ['title' => '5 Reasons to Book a Head Massage Today',
                 'content' => "A head massage isn't just relaxing — it has real health benefits:\n\n1. Reduces stress and anxiety instantly.\n2. Improves blood circulation to the scalp.\n3. Promotes hair growth by stimulating follicles.\n4. Relieves headaches and migraines.\n5. Improves sleep quality.\n\nOur therapists use premium nourishing oils tailored to your hair type. Book a 30-minute session today for just \$25."],

                ['title' => 'How to Choose the Right Haircut for Your Face Shape',
                 'content' => "Not every haircut suits every face shape. Here's a quick guide:\n\nOval Face — Lucky you! Almost any style works.\nRound Face — Go for height on top, avoid width on the sides.\nSquare Face — Soften angles with textured or layered cuts.\nHeart Face — Side-swept styles balance a wider forehead.\nOblong Face — Avoid very long styles; add width with layers.\n\nBook a consultation with our expert barbers and we'll recommend the perfect cut for you."],
            ];

            foreach ($posts as $p) {
                Post::firstOrCreate(
                    ['title' => $p['title']],
                    ['content' => $p['content'], 'user_id' => $admin->id]
                );
            }
        }

        // ── 20 Contact Messages ───────────────────────────────────
        $contacts = [
            ['name' => 'Ali Hassan',       'phone' => '0300-1234567', 'email' => 'ali.hassan@gmail.com',       'address' => 'House 12, Block A, Lahore',         'message' => 'I would like to book a haircut appointment for this weekend. Please let me know your availability.'],
            ['name' => 'Sara Ahmed',       'phone' => '0321-9876543', 'email' => 'sara.ahmed@gmail.com',       'address' => 'Flat 5, DHA Phase 2, Karachi',      'message' => 'Do you offer home services for women? I am interested in a hair spa treatment.'],
            ['name' => 'Usman Khan',       'phone' => '0333-4567890', 'email' => 'usman.khan@yahoo.com',       'address' => 'Street 7, G-10, Islamabad',         'message' => 'What are your working hours? I want to schedule a beard trim.'],
            ['name' => 'Fatima Malik',     'phone' => '0345-6543210', 'email' => 'fatima.malik@hotmail.com',   'address' => 'Gulshan-e-Iqbal, Karachi',          'message' => 'I had a great experience last time. Booking again for a facial cleanup.'],
            ['name' => 'Bilal Raza',       'phone' => '0311-2345678', 'email' => 'bilal.raza@gmail.com',       'address' => 'Model Town, Lahore',                'message' => 'Can I get a package deal for haircut and beard styling together?'],
            ['name' => 'Ayesha Siddiqui',  'phone' => '0322-8765432', 'email' => 'ayesha.siddiqui@gmail.com', 'address' => 'Bahria Town, Rawalpindi',            'message' => 'I am looking for a professional for a bridal hair package. Do you offer that?'],
            ['name' => 'Hamza Sheikh',     'phone' => '0334-3456789', 'email' => 'hamza.sheikh@gmail.com',     'address' => 'Johar Town, Lahore',                'message' => 'Your service was excellent! I will definitely recommend Salon Prime to my friends.'],
            ['name' => 'Zara Qureshi',     'phone' => '0346-7654321', 'email' => 'zara.qureshi@yahoo.com',    'address' => 'Clifton Block 4, Karachi',           'message' => 'Please confirm if you have availability on Saturday morning for a manicure and pedicure.'],
            ['name' => 'Tariq Mehmood',    'phone' => '0312-5678901', 'email' => 'tariq.mehmood@gmail.com',   'address' => 'Saddar, Rawalpindi',                'message' => 'I want to inquire about your hair color services and pricing.'],
            ['name' => 'Nadia Hussain',    'phone' => '0323-4321098', 'email' => 'nadia.hussain@gmail.com',   'address' => 'F-7 Markaz, Islamabad',             'message' => 'Do you have female professionals available for home visits in Islamabad?'],
            ['name' => 'Kamran Ali',       'phone' => '0335-6789012', 'email' => 'kamran.ali@hotmail.com',    'address' => 'Township, Lahore',                  'message' => 'I would like to know more about your de-tan treatment. What products do you use?'],
            ['name' => 'Sana Baig',        'phone' => '0347-2109876', 'email' => 'sana.baig@gmail.com',       'address' => 'North Nazimabad, Karachi',           'message' => 'Can I reschedule my booking? I had an appointment for Monday but need to change it.'],
            ['name' => 'Faisal Iqbal',     'phone' => '0313-7890123', 'email' => 'faisal.iqbal@gmail.com',    'address' => 'Wapda Town, Lahore',                'message' => 'Great service! The barber was very professional and on time. Will book again soon.'],
            ['name' => 'Hina Nawaz',       'phone' => '0324-5432109', 'email' => 'hina.nawaz@yahoo.com',      'address' => 'Gulberg III, Lahore',               'message' => 'I am interested in a monthly grooming package. Do you offer any subscription plans?'],
            ['name' => 'Asad Javed',       'phone' => '0336-8901234', 'email' => 'asad.javed@gmail.com',      'address' => 'E-11, Islamabad',                   'message' => 'What is the cancellation policy if I need to cancel my booking last minute?'],
            ['name' => 'Rabia Farooq',     'phone' => '0348-3210987', 'email' => 'rabia.farooq@gmail.com',    'address' => 'PECHS Block 2, Karachi',             'message' => 'I loved the waxing service! The professional was very gentle and thorough.'],
            ['name' => 'Imran Butt',       'phone' => '0314-9012345', 'email' => 'imran.butt@hotmail.com',    'address' => 'Cavalry Ground, Lahore',            'message' => 'Do you offer gift cards? I want to give a Salon Prime experience as a gift.'],
            ['name' => 'Mariam Zahid',     'phone' => '0325-6543210', 'email' => 'mariam.zahid@gmail.com',    'address' => 'Askari 10, Lahore',                 'message' => 'I have sensitive skin. Can you confirm which products are used for the facial cleanup?'],
            ['name' => 'Shahid Nawaz',     'phone' => '0337-0123456', 'email' => 'shahid.nawaz@gmail.com',    'address' => 'Hayatabad Phase 3, Peshawar',       'message' => 'Do you operate in Peshawar? I would love to try your services here.'],
            ['name' => 'Amna Riaz',        'phone' => '0349-4321098', 'email' => 'amna.riaz@yahoo.com',       'address' => 'Satellite Town, Rawalpindi',        'message' => 'The head massage was absolutely amazing. I felt so relaxed. Highly recommended!'],
        ];

        foreach ($contacts as $c) {
            Contact::create([
                'name'    => $c['name'],
                'phone'   => $c['phone'],
                'email'   => $c['email'],
                'address' => $c['address'],
                'message' => $c['message'],
                'is_read' => (bool) rand(0, 1),
            ]);
        }

        $this->command->info('✅ 20 users, 20 bookings, 10 posts, 20 contact messages seeded!');
    }
}
