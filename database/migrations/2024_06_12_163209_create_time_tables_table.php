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
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('class_names')->onDelete('cascade');
            $table->foreignId('week_id')->constrained('week_modals')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subject_models')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('teacher_modals')->onDelete('cascade'); 
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_tables');
    }
};
