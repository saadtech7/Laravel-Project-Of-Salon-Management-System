<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OnlyAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing admin if exists
        User::where('email', 'saad@admin.com')->delete();
        
        // Create admin user
        User::create([
            'name' => 'Saad Admin',
            'email' => 'saad@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        echo "Admin user created successfully!\n";
        echo "Email: saad@admin.com\n";
        echo "Password: 12345678\n";
    }
}