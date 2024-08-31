<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $table = 'student_attendances';

    protected $fillable = ['student_id', 'class_id', 'attendance_date', 'attendance_type'];

    // Define the relationships to the student and class
    public function student()
    {
        return $this->belongsTo(StudentModal::class, 'student_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }
}
