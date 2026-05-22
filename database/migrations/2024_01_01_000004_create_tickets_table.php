<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number', 30)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('category_id')->nullable();  // reserved for future category module
            $table->foreignId('location_id')->nullable()->constrained('facilities')->onDelete('set null');
            $table->string('title', 255);
            $table->text('description');
            $table->enum('priority_level', ['urgent', 'high', 'normal'])->default('normal');
            $table->string('photo_path')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'assigned', 'ongoing', 'resolved', 'completed'])
                  ->default('pending');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'priority_level']);
            $table->index('user_id');
            $table->index('assigned_to');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
