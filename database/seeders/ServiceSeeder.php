<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // ── MEN ──
            ['category'=>'men','name'=>'Haircut & Beard Styling',  'description'=>'Precision haircut with expert beard shaping and styling.',       'price'=>39,'duration'=>40,'icon'=>'✂️','rating'=>4.86,'review_count'=>741000,'image'=>'img/1.avif'],
            ['category'=>'men','name'=>'Facial & Cleanup',         'description'=>'Deep cleansing facial with skin brightening cleanup.',            'price'=>35,'duration'=>45,'icon'=>'🧖','rating'=>4.82,'review_count'=>512000,'image'=>'img/2.avif'],
            ['category'=>'men','name'=>'De-Tan Treatment',         'description'=>'Remove tan and restore your natural skin tone.',                  'price'=>30,'duration'=>30,'icon'=>'☀️','rating'=>4.78,'review_count'=>320000,'image'=>'img/3.avif'],
            ['category'=>'men','name'=>'Manicure & Pedicure',      'description'=>'Complete nail care and grooming for hands and feet.',             'price'=>28,'duration'=>50,'icon'=>'💅','rating'=>4.75,'review_count'=>280000,'image'=>'img/4.avif'],
            ['category'=>'men','name'=>'Head Massage',             'description'=>'Relaxing scalp and head massage to relieve stress.',              'price'=>25,'duration'=>30,'icon'=>'💆','rating'=>4.90,'review_count'=>430000,'image'=>'img/5.avif'],
            ['category'=>'men','name'=>'Hair Color',               'description'=>'Professional hair coloring with premium products.',               'price'=>55,'duration'=>60,'icon'=>'🎨','rating'=>4.72,'review_count'=>195000,'image'=>'img/6.avif'],
            ['category'=>'men','name'=>'Haircut & Massage',        'description'=>'Haircut for men plus a 10-min relaxing head massage.',           'price'=>45,'duration'=>50,'icon'=>'💈','rating'=>4.88,'review_count'=>620000,'image'=>'img/7.avif'],
            ['category'=>'men','name'=>'Beard Trim',               'description'=>'Expert beard shaping, trimming and line-up.',                    'price'=>15,'duration'=>20,'icon'=>'🧔','rating'=>4.84,'review_count'=>390000,'image'=>'img/8.avif'],

            // ── WOMEN ──
            ['category'=>'women','name'=>'Haircut & Styling',      'description'=>'Precision cut with blowdry and professional styling.',           'price'=>49,'duration'=>60,'icon'=>'💇','rating'=>4.91,'review_count'=>820000,'image'=>'img/9.avif'],
            ['category'=>'women','name'=>'Hair Spa',               'description'=>'Deep conditioning spa treatment for silky smooth hair.',          'price'=>55,'duration'=>60,'icon'=>'🌿','rating'=>4.87,'review_count'=>560000,'image'=>'img/10.avif'],
            ['category'=>'women','name'=>'Facial & Cleanup',       'description'=>'Brightening facial with deep pore cleansing treatment.',         'price'=>40,'duration'=>50,'icon'=>'✨','rating'=>4.85,'review_count'=>710000,'image'=>'img/11.avif'],
            ['category'=>'women','name'=>'Waxing',                 'description'=>'Full body or partial waxing with gentle wax formula.',           'price'=>35,'duration'=>45,'icon'=>'🌸','rating'=>4.80,'review_count'=>490000,'image'=>'img/12.avif'],
            ['category'=>'women','name'=>'Manicure & Pedicure',    'description'=>'Luxury nail care with gel polish and cuticle treatment.',        'price'=>38,'duration'=>60,'icon'=>'💅','rating'=>4.83,'review_count'=>375000,'image'=>'img/13.avif'],
            ['category'=>'women','name'=>'Hair Color',             'description'=>'Global or highlight coloring with premium salon products.',      'price'=>75,'duration'=>90,'icon'=>'🎨','rating'=>4.76,'review_count'=>240000,'image'=>'img/14.avif'],
            ['category'=>'women','name'=>'De-Tan Treatment',       'description'=>'Skin brightening and tan removal for face and body.',            'price'=>32,'duration'=>35,'icon'=>'☀️','rating'=>4.79,'review_count'=>310000,'image'=>'img/15.avif'],
            ['category'=>'women','name'=>'Head Massage',           'description'=>'Therapeutic scalp massage with nourishing oils.',               'price'=>28,'duration'=>30,'icon'=>'💆','rating'=>4.92,'review_count'=>450000,'image'=>'img/16.avif'],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(
                ['name' => $s['name'], 'category' => $s['category']],
                array_merge($s, ['is_active' => true, 'image' => null])
            );
        }
    }
}
