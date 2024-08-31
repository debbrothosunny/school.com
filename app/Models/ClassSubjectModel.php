<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ClassSubjectModel extends Model
{
    use HasFactory;
    
    protected $table = 'class_subject_models';

    protected $fillable = ['class_id', 'subject_id', 'created_by', 'status'];

    public function class()
    {
        return $this->belongsTo(ClassName::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(SubjectModel::class, 'subject_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }



    //  10:07pm 15-06 
    // public static function MySubject($class_id)
    // {
    //     return self::select('class_subject.*', 'subject.name as subject_name', 'subject.type as subject_type')
    //         ->join('subject', 'subject.id', '=', 'class_subject.subject_id')
    //         ->join('class', 'class.id', '=', 'class_subject.class_id')
    //         ->join('users', 'users.id', '=', 'class_subject.created_by')
    //         ->where('class_subject.class_id', '=', $class_id)
    //         ->where('class_subject.is_delete', '=', 0)
    //         ->orderBy('class_subject.id', 'desc')
    //         ->get();
    // }
}
