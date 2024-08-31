<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'book_id', 'booking_date', 'return_date'
    ];

    protected $dates = [
        'booking_date',
        'return_date'
    ];

     // Optionally, define relationships// Relationship with the StudentModal model
    public function student()
    {
        return $this->belongsTo(StudentModal::class, 'student_id');
    }

    // Relationship with the Library model (for the book)
    public function book()
    {
        return $this->belongsTo(Library::class, 'book_id');
    }
}
