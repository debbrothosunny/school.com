<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_name',
        'note',
        'created_by',
        'is_delete',
        'status',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


   // This Is exam_schedule
    public function examSchedules()
    {
        return $this->hasMany(ExamSchedule::class, 'exam_id');
    }

   // Define the relationship to results
    public function results()
    {
        return $this->hasMany(Result::class);
    }


    // Soft Delete
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('nonDeleted', function (Builder $builder) {
            $builder->where('exams.is_delete', 0);
        });
    }
}
