<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'subject_id', 'exam_id', 'class_id', 
        'class_work', 'home_work', 'test_work', 'exam_work',
    ];


    public function student()
    {
        return $this->belongsTo(StudentModal::class);
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function className()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }

}
