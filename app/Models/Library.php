<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_title', 'author', 'publisher', 'isbn', 'published_year',
        'category', 'language', 'copies_available', 'created_by', 'status'
    ];


    public function bookings()
     {
         return $this->hasMany(Booking::class, 'student_id');
     }
}
