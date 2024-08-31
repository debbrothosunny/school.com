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
        Schema::create('home_works', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->foreignId('teacher_id')->constrained('teacher_modals')->onDelete('cascade');
            $table->date('homework_date');
            $table->date('submission_date');
            $table->text('document');
            $table->text('description');
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('class_id')->references('id')->on('class_names')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subject_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_works');
    }
};
