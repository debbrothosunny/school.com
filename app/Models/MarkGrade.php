<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkGrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_name',
        'percent_from',
        'percent_to',
        'created_by'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public static function getGrade($percent)
    {
        return self::where('percent_from', '<=', $percent)
                    ->where('percent_to', '>=', $percent)
                    ->first();
    }
}
