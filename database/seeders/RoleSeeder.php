<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrator',       'slug' => 'admin'],
            ['name' => 'Faculty/Staff',        'slug' => 'faculty'],
            ['name' => 'Maintenance Staff',    'slug' => 'maintenance'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['slug' => $role['slug']], $role);
        }
    }
}
