<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModal extends Model
{
    use HasFactory;

    protected $table = 'parent_modals'; // Ensure this matches your table name
    
    protected $fillable = [
        'user_id', 'student_id', 'name', 'address', 'status', 'profile_pic', 'gender', 'mobile_number', 'occupation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    

    //admin side to show My Student
    public function student()
    {
        return $this->belongsTo(StudentModal::class, 'student_id');
    }

    // parent side to show My Student Fees and also my student
    public function students()
    {
        return $this->hasMany(StudentModal::class, 'id', 'student_id');
    }


    // Use the boot method to handle the deletion event
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($parent) {
            // Delete the associated user when the parent is deleted
            if ($parent->user) {
                $parent->user->delete();
            }
        });
    }





}


