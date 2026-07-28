<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update old category values to new ones
        DB::table('tickets')->where('issue_category', 'structural')->update(['issue_category' => 'carpentry']);
        DB::table('tickets')->where('issue_category', 'furniture')->update(['issue_category' => 'carpentry']);
        DB::table('tickets')->where('issue_category', 'hvac')->update(['issue_category' => 'others']);
        DB::table('tickets')->where('issue_category', 'sanitation')->update(['issue_category' => 'others']);
        DB::table('tickets')->where('issue_category', 'network')->update(['issue_category' => 'others']);

        // Update ENUM column
        DB::statement("ALTER TABLE tickets MODIFY COLUMN issue_category ENUM('electrical','plumbing','carpentry','masonry','welding','others') NOT NULL DEFAULT 'others'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE tickets MODIFY COLUMN issue_category ENUM('electrical','plumbing','structural','hvac','furniture','sanitation','network','others') NOT NULL DEFAULT 'others'");
    }
};
