<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            ['building_name' => 'Main Building',        'room_number' => '101', 'floor' => '1st Floor', 'description' => 'Administration Office'],
            ['building_name' => 'Main Building',        'room_number' => '201', 'floor' => '2nd Floor', 'description' => 'Faculty Room'],
            ['building_name' => 'Main Building',        'room_number' => '301', 'floor' => '3rd Floor', 'description' => 'Conference Room'],
            ['building_name' => 'Science Building',     'room_number' => '101', 'floor' => '1st Floor', 'description' => 'Chemistry Laboratory'],
            ['building_name' => 'Science Building',     'room_number' => '102', 'floor' => '1st Floor', 'description' => 'Physics Laboratory'],
            ['building_name' => 'Library Building',     'room_number' => null,  'floor' => '1st Floor', 'description' => 'Main Library'],
            ['building_name' => 'Gymnasium',            'room_number' => null,  'floor' => 'Ground',    'description' => 'Sports Gymnasium'],
            ['building_name' => 'Computer Laboratory',  'room_number' => '101', 'floor' => '1st Floor', 'description' => 'Computer Lab 1'],
            ['building_name' => 'Computer Laboratory',  'room_number' => '102', 'floor' => '1st Floor', 'description' => 'Computer Lab 2'],
            ['building_name' => 'Chapel',               'room_number' => null,  'floor' => 'Ground',    'description' => 'SCC Chapel'],
            ['building_name' => 'Canteen',              'room_number' => null,  'floor' => 'Ground',    'description' => 'School Canteen'],
            ['building_name' => 'Dormitory',            'room_number' => null,  'floor' => 'Multiple',  'description' => 'Student Dormitory'],
        ];

        foreach ($facilities as $facility) {
            Facility::firstOrCreate(
                ['building_name' => $facility['building_name'], 'room_number' => $facility['room_number']],
                $facility
            );
        }
    }
}
