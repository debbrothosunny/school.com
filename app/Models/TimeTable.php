<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'subject_id',
        'week_id',
        'start_time',
        'end_time',
        'room_number',
    ];

    public function className()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function week()
    {
        return $this->belongsTo(WeekModal::class, 'week_id');
    }

    public function teacher()
{
    return $this->belongsTo(TeacherModal::class, 'teacher_id');
}
}
