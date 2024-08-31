<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StudentModal extends Model
{
    use HasFactory;


    protected $table = 'student_modals';

    protected $fillable = [
        'user_id', 'admission_number', 'roll_number', 'class_id', 'first_name', 'last_name', 'gender',
        'd_o_b', 'caste', 'religion', 'mobile_number', 'admission_date', 'profile_pic', 'blood_group',
        'height', 'weight', 'status'
    ];

    public function class()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }

    // Teacher Side To Show My Student
    public function className()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }



    // parent side to show My Student
    public function parents()
    {
        return $this->belongsToMany(ParentModal::class, 'parent_students', 'student_id', 'parent_id');
    }


    // Fees Collection
    public function feesCollection()
    {
        return $this->hasMany(StudentFees::class, 'student_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function students()
    {
        return $this->belongsToMany(StudentModal::class, 'parent_student', 'parent_id', 'student_id');
    } 


    // Student Attendence Relationship
    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class, 'student_id');
    }


    public function assignClassTeachers()
    {
        return $this->hasMany(AssignClassTeacher::class, 'student_id');
    }



    // Relationship with HomeWork through ClassName and Subject
    public function homeworks()
    {
        return $this->hasManyThrough(HomeWork::class, ClassName::class, 'id', 'class_id', 'class_id', 'id');
    }


    // student home work submit
    public function homeworkSubmissions()
    {
        return $this->hasMany(StudentHomeworkSubmission::class, 'student_id');
    }

    // Example method to calculate paidAmount
    public function getPaidAmountAttribute()
    {
        // Assuming feesCollection is a relationship to FeesCollection model
        return $this->feesCollection->sum('paid_amount');
    }


    // Result Page
    public function marks()
    {
        return $this->hasMany(Mark::class, 'student_id', 'id');
    }

   //  parent side to show My Student Fees

   public function parent()
    {
        return $this->hasMany(ParentModal::class, 'student_id');
    }

    public function fees()
    {
        return $this->hasMany(StudentFees::class, 'student_id');
    }

    // Define the relationship to results
    

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}


