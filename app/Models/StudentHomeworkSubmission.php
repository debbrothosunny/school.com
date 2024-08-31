<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentHomeworkSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'homework_id',
        'student_id',
        'document',
        'description'
    ];


     // student My submitted Home Work
    public function homework()
    {
        return $this->belongsTo(HomeWork::class);
    }


    // admin side to show student sumitted homewrok
    public function student()
    {
        return $this->belongsTo(StudentModal::class, 'student_id');
    }

}
