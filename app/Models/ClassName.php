<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{
    use HasFactory;

    protected $table = 'class_names';  


    public static function getClass()
    {
        return self::all();  
    }
    
    // Teacher Side To Show My Student
    public function students()
    {
        return $this->hasMany(StudentModal::class, 'class_id');
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubjectModel::class, 'class_id');
    }
  

    public function assignedTeachers()
    {
        return $this->hasMany(AssignClassTeacher::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(TeacherModal::class);
    }

     // Teacher Side To Show My Student
   
    public function timeTables()
    {
        return $this->hasMany(TimeTable::class, 'class_id');
    }

    //Class Time Table also Exam Schedule Time Table
    public function subjects()
    {
        return $this->belongsToMany(SubjectModel::class, 'class_subject_models', 'class_id', 'subject_id');
    }




    






    // One-to-many relationship with ExamSchedule
    public function examSchedules()
    {
        return $this->hasMany(ExamSchedule::class, 'class_id');
    }





    //  Teacher side to show home work
    
    public function assignClassTeachers()
    {
        return $this->hasMany(AssignClassTeacher::class, 'class_id', 'id');
    }


    // Define the relationship to results
    public function results()
    {
        return $this->hasMany(Result::class, 'class_id');
    }

    
}
