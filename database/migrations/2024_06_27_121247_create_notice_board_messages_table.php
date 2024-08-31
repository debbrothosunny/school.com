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
        Schema::create('notice_board_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notice_board_id');
            $table->string('message_to')->nullable();
            // Foreign key constraint
            $table->foreign('notice_board_id')->references('id')->on('notice_boards')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notice_board_messages');
    }
};
