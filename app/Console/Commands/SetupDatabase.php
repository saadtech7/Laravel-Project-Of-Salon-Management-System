<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the database with migrations and sample data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up database...');
        
        // Clear config cache
        $this->info('Clearing config cache...');
        Artisan::call('config:clear');
        
        // Run migrations
        $this->info('Running migrations...');
        Artisan::call('migrate');
        
        // Run seeders
        $this->info('Seeding database with sample data...');
        Artisan::call('db:seed');
        
        $this->info('Database setup completed successfully!');
        $this->info('');
        $this->info('Sample login credentials:');
        $this->info('Admin: admin@example.com / admin123');
        $this->info('User: alice@example.com / user123');
        $this->info('');
        $this->info('You can now check phpMyAdmin to see the data.');
        
        return 0;
    }
}