<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->foreignId('maintenance_staff_id')->constrained('users')->onDelete('cascade');
            $table->text('action_taken');
            $table->text('repair_notes')->nullable();
            $table->decimal('repair_cost', 10, 2)->default(0.00);
            $table->text('materials_used')->nullable();
            $table->enum('status', ['ongoing', 'resolved'])->default('ongoing');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_logs');
    }
};
