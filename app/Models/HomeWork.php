<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeWork extends Model
{
    use HasFactory;

    protected $table = 'home_works';  

    protected $fillable = [
        'class_id', 'subject_id', 'teacher_id', 'homework_date', 'submission_date', 'document', 'description', 'is_deleted'
    ];


    public function className()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }
    public function teacher()
    {
        return $this->belongsTo(TeacherModal::class, 'teacher_id');
    }


    // student home work submit
    public function submissions()
    {
        return $this->hasMany(StudentHomeworkSubmission::class, 'homework_id');
    }
}
