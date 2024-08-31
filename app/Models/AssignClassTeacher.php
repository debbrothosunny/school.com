<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class AssignClassTeacher extends Model
{
    use HasFactory;

    protected $table = 'assign_class_teachers';

    protected $fillable = [
        'class_id',
        'teacher_id',
        'created_by',
        'subject_id',
        'status',
    ];

    public function className()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(TeacherModal::class, 'teacher_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    // assign class teacher relationship
    public function subjects()
        {
            return $this->belongsToMany(SubjectModel::class, 'assign_class_teachers', 'teacher_id', 'subject_id');
        }
   
}