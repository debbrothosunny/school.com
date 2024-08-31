<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('student_modals')->onDelete('cascade'); // Foreign key referencing students table
            $table->foreignId('book_id')->constrained('libraries')->onDelete('cascade'); // Foreign key referencing libraries table
            $table->date('booking_date'); // Date of the booking
            $table->date('return_date')->nullable(); // Add return_date column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
