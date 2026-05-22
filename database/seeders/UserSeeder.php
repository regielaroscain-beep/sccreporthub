<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole       = Role::where('slug', 'admin')->first();
        $facultyRole     = Role::where('slug', 'faculty')->first();
        $maintenanceRole = Role::where('slug', 'maintenance')->first();

        // Admin
        User::firstOrCreate(['email' => 'admin@scc.edu.ph'], [
            'role_id'        => $adminRole->id,
            'first_name'     => 'System',
            'last_name'      => 'Administrator',
            'password'       => Hash::make('Admin@1234'),
            'department'     => 'IT Department',
            'contact_number' => '09000000001',
            'status'         => 'active',
        ]);

        // Faculty/Staff
        User::firstOrCreate(['email' => 'faculty@scc.edu.ph'], [
            'role_id'        => $facultyRole->id,
            'first_name'     => 'Maria',
            'last_name'      => 'Santos',
            'password'       => Hash::make('Faculty@1234'),
            'department'     => 'College of Education',
            'contact_number' => '09000000002',
            'status'         => 'active',
        ]);

        User::firstOrCreate(['email' => 'faculty2@scc.edu.ph'], [
            'role_id'        => $facultyRole->id,
            'first_name'     => 'Juan',
            'last_name'      => 'Dela Cruz',
            'password'       => Hash::make('Faculty@1234'),
            'department'     => 'College of Business',
            'contact_number' => '09000000003',
            'status'         => 'active',
        ]);

        // Maintenance Staff
        User::firstOrCreate(['email' => 'maintenance@scc.edu.ph'], [
            'role_id'        => $maintenanceRole->id,
            'first_name'     => 'Pedro',
            'last_name'      => 'Reyes',
            'password'       => Hash::make('Maintenance@1234'),
            'department'     => 'Facilities & Maintenance',
            'contact_number' => '09000000004',
            'status'         => 'active',
        ]);

        User::firstOrCreate(['email' => 'maintenance2@scc.edu.ph'], [
            'role_id'        => $maintenanceRole->id,
            'first_name'     => 'Carlos',
            'last_name'      => 'Mendoza',
            'password'       => Hash::make('Maintenance@1234'),
            'department'     => 'Facilities & Maintenance',
            'contact_number' => '09000000005',
            'status'         => 'active',
        ]);
    }
}
