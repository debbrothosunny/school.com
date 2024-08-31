<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    use HasFactory;

    protected $table = 'subject_models';

    protected $fillable = [
        'subject_name',
        'type',
        'created_by',
        'created_by',
        'status'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubjectModel::class, 'subject_id');
    }

    public function assignClassTeachers()
    {
        return $this->hasMany(AssignClassTeacher::class, 'subject_id');
    }

   // Class Time Table also  //Exam schedule  
    public function classes()
    {
        return $this->belongsToMany(ClassName::class, 'class_subject_models', 'subject_id', 'class_id');
    }


    // Mark Register and also show Result 
    public function examSchedules()
    {
        return $this->hasMany(ExamSchedule::class, 'subject_id');
    }
  
    // teacher show my class
    public function assignedClasses()
    {
        return $this->hasMany(AssignClassTeacher::class, 'subject_id');
    }



    // Home Work
    public function homeworks()
    {
        return $this->hasMany(HomeWork::class, 'subject_id');
    }

    public function assignments()
    {
        return $this->hasMany(AssignClassTeacher::class, 'subject_id');
    }


    // Parent Side to show my student result Print function 
    public function marks()
    {
        return $this->hasMany(Mark::class, 'subject_id');
    }







    



}


