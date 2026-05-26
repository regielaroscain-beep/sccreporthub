<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('issue_category', [
                'electrical',
                'plumbing',
                'structural',
                'hvac',
                'furniture',
                'sanitation',
                'network',
                'others',
            ])->default('others')->after('location_id');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('issue_category');
        });
    }
};
