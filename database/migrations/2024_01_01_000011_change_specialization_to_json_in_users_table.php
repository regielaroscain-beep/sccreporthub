<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Convert existing string values to JSON array before changing column type
        DB::table('users')
            ->whereNotNull('specialization')
            ->get()
            ->each(function ($user) {
                $current = $user->specialization;
                // Skip if already JSON array
                if (!str_starts_with(trim($current), '[')) {
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['specialization' => json_encode([$current])]);
                }
            });

        // Change column to JSON
        DB::statement('ALTER TABLE users MODIFY COLUMN specialization JSON NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE users MODIFY COLUMN specialization VARCHAR(255) NULL');
    }
};
