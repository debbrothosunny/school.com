<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TeacherModal extends Model
{
    use HasFactory;

    protected $table = 'teacher_modals'; 
    
    protected $fillable = [
        'user_id',
        'name',
        'marital_status',
        'qualification',
        'gender',
        'd_o_b',
        'c_address',
        'p_address',
        'religion',
        'mobile_number',
        'd_o_j',
        'profile_pic',
        'experience',
        'note',
        'blood_group',
        'status'
    ];

 


    public function assignedClasses()
    {
        return $this->hasMany(AssignClassTeacher::class, 'teacher_id');
    }

    // Tecaher Side To Show My Student and My_exam_schedule
    public function classess()
    {
        return $this->hasMany(ClassName::class);
    }

     //  Teacher side to show home work
    public function assignClassTeachers()
    {
        return $this->hasMany(AssignClassTeacher::class, 'teacher_id', 'id');
    }



    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
