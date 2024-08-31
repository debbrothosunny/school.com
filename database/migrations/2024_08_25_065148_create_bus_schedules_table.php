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
        Schema::create('bus_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->string('bus_number');
            $table->string('route_name');
            $table->string('driver_name');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('start_location');
            $table->string('end_location');
            $table->string('days_of_operation'); // e.g., "Monday-Friday"
            $table->integer('capacity');
            $table->string('contact_number');
            $table->tinyInteger('status')->default(0); 
            $table->text('remarks');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('class_id')->references('id')->on('class_names')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_schedules');
    }
};
