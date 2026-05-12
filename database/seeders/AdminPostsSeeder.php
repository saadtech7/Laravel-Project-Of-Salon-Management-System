<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class AdminPostsSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $this->command->warn('No admin user found. Please seed an admin first.');
            return;
        }

        $posts = [
            [
                'title'   => 'Welcome to Salon Prime — Your Premium Grooming Destination',
                'content' => "We're thrilled to launch Salon Prime, your go-to destination for professional grooming services delivered right to your doorstep.\n\nOur team of verified, experienced professionals is dedicated to giving you the best haircut, beard styling, facial, and more — all from the comfort of your home.\n\nBook your first appointment today and experience the difference. Use code PRIME5 for \$5 off your first booking!",
            ],
            [
                'title'   => 'Top 5 Haircut Trends for Men in 2026',
                'content' => "Staying on top of the latest trends is key to looking sharp. Here are the top 5 men's haircut trends dominating 2026:\n\n1. **Textured Crop** — Clean on the sides, textured on top.\n2. **Modern Pompadour** — A timeless classic with a contemporary twist.\n3. **Buzz Cut Fade** — Minimal maintenance, maximum style.\n4. **Curtain Bangs** — Making a strong comeback this year.\n5. **Slick Back Undercut** — Bold, confident, and always in style.\n\nBook a session with our expert barbers to get any of these looks today!",
            ],
            [
                'title'   => 'Why At-Home Salon Services Are the Future of Grooming',
                'content' => "The grooming industry has shifted dramatically. More and more people are choosing at-home salon services over traditional barbershops — and for good reason.\n\n**Convenience** — No commute, no waiting. Your barber comes to you.\n**Safety** — One-on-one service in your own space.\n**Personalization** — Your barber focuses entirely on you.\n**Time-saving** — Get groomed during your lunch break or after work.\n\nAt Salon Prime, we bring the full salon experience to your door. Try it once and you'll never go back.",
            ],
            [
                'title'   => 'How to Maintain Your Beard Between Appointments',
                'content' => "A great beard doesn't maintain itself. Here are our top tips to keep your beard looking sharp between professional trims:\n\n- **Wash regularly** — Use a beard shampoo 2-3 times a week.\n- **Moisturize daily** — Beard oil keeps skin hydrated and reduces itchiness.\n- **Comb it out** — A beard comb prevents tangles and trains growth direction.\n- **Trim the edges** — Use a trimmer to keep the neckline and cheek lines clean.\n- **Eat well** — A protein-rich diet promotes healthy beard growth.\n\nBook a beard trim with us every 2-3 weeks for the best results.",
            ],
            [
                'title'   => 'Introducing Women\'s Services at Salon Prime',
                'content' => "We're excited to announce the launch of our full range of women's grooming and beauty services!\n\nFrom precision haircuts and blowouts to hair spa treatments, waxing, facials, and manicures — our certified female professionals are here to pamper you.\n\nAll services are performed at your home with premium, salon-grade products. No more rushing to the salon — we come to you.\n\nExplore our women's services and book your first appointment today!",
            ],
            [
                'title'   => 'The Benefits of a Professional Facial Cleanup',
                'content' => "A facial cleanup is one of the most underrated grooming treatments for both men and women. Here's why you should book one:\n\n**Deep pore cleansing** — Removes dirt, oil, and dead skin cells that daily washing misses.\n**Brightening effect** — Instantly improves skin tone and texture.\n**Anti-aging** — Regular cleanups slow down the appearance of fine lines.\n**Relaxation** — The massage component relieves facial tension.\n\nOur professionals use dermatologist-approved products suited to your skin type. Book a facial cleanup today and see the difference after just one session.",
            ],
            [
                'title'   => 'Salon Prime\'s Hygiene & Safety Standards',
                'content' => "Your safety is our top priority. Here's how we ensure every service meets the highest hygiene standards:\n\n- All tools are sterilized before and after every appointment.\n- Professionals wear gloves and masks during services.\n- Single-use items (razors, wax strips) are never reused.\n- All professionals undergo regular health checks.\n- Products used are certified and allergen-tested.\n\nYou can book with complete confidence knowing that Salon Prime holds itself to the strictest safety protocols in the industry.",
            ],
            [
                'title'   => 'Customer Spotlight: Real Stories from Our Clients',
                'content' => "Nothing makes us prouder than hearing from our happy customers. Here are a few recent reviews:\n\n⭐⭐⭐⭐⭐ *\"Best haircut I've ever had. The barber was on time, professional, and the result was exactly what I wanted.\"* — James C.\n\n⭐⭐⭐⭐⭐ *\"The hair spa treatment was absolutely amazing. My hair feels so soft and healthy. Will definitely book again!\"* — Sophia W.\n\n⭐⭐⭐⭐⭐ *\"I was skeptical about at-home services but Salon Prime completely changed my mind. Highly recommend!\"* — Noah D.\n\nJoin thousands of satisfied customers and book your appointment today.",
            ],
        ];

        foreach ($posts as $post) {
            Post::firstOrCreate(
                ['title' => $post['title']],
                [
                    'content' => $post['content'],
                    'user_id' => $admin->id,
                ]
            );
        }

        $this->command->info('✅ ' . count($posts) . ' admin posts seeded successfully.');
    }
}
