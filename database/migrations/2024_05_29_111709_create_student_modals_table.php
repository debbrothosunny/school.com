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
        Schema::create('student_modals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->string('admission_number')->unique();
            $table->string('roll_number')->unique();
            $table->unsignedBigInteger('class_id'); // Assuming class is related to a ClassName table
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('d_o_b');
            $table->string('caste')->nullable();
            $table->string('religion')->nullable();
            $table->string('mobile_number')->unique();
            $table->date('admission_date');
            $table->string('profile_pic')->nullable();  
            $table->string('blood_group')->nullable();
            $table->decimal('height', 5, 2)->nullable(); // e.g., 5.11 for height
            $table->decimal('weight', 5, 2)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(0); // Default status 0
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('class_names')->onDelete('cascade'); // Foreign key for class_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_modals', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['parent_id']); // Drop the foreign key for parent_id
            $table->dropForeign(['class_id']); // Drop the foreign key for class_id
        });
        Schema::dropIfExists('student_modals');
    }
};
