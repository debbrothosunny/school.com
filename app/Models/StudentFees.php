<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFees extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_id',
        'class_id',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'payment_type',
        'created_by',
    ];

    protected $table = 'student_fees';


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }



    // student Side to show My Fees

    public function student()
    {
        return $this->belongsTo(StudentModal::class, 'student_id');
    }
    public function class()
    {
        return $this->belongsTo(ClassName::class);
    }



}







