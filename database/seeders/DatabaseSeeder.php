<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Run: php artisan db:seed
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FacilitySeeder::class,
        ]);

        $this->command->info('✅ SCC ReportHub database seeded successfully!');
        $this->command->table(
            ['Role', 'Email', 'Password'],
            [
                ['Administrator',    'admin@scc.edu.ph',        'Admin@1234'],
                ['Faculty/Staff',    'faculty@scc.edu.ph',      'Faculty@1234'],
                ['Maintenance Staff','maintenance@scc.edu.ph',  'Maintenance@1234'],
            ]
        );
    }
}
