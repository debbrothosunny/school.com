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
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->text('book_title'); // Title of the book
            $table->text('author'); // Author of the book
            $table->text('publisher'); // Publisher of the book
            $table->string('isbn', 20); // ISBN number of the book
            $table->year('published_year'); // Year of publication
            $table->text('category'); // Book category/genre
            $table->string('language', 50); // Language of the book
            $table->integer('copies_available')->default(0); // Number of copies available
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Foreign key referencing users table
            $table->string('status')->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
    }
};
