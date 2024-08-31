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
        Schema::create('teacher_modals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); 
            $table->string('name');
            $table->string('marital_status');
            $table->string('qualification');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('d_o_b');
            $table->text('c_address')->nullable();//current address
            $table->text('p_address')->nullable();//permanent address
            $table->string('religion')->nullable();
            $table->string('mobile_number')->unique();
            $table->date('d_o_j');//Date Odf Joining
            $table->string('profile_pic')->nullable();
            $table->string('experience')->nullable();
            $table->string('note')->nullable();
            $table->string('blood_group')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_modals');
    }
};