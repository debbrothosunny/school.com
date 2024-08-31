<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    

    static public function getEmailSingle($email)
    {
    return User::where('email', '=', $email)->first();
    }


    public static function getSingle($id)
    {
        return self::find($id);
    }
    
    static public function getAdmin()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 1);
    
        if (!empty(Request::get('date'))) {
            $return = $return->whereDate('created_at', 'like','%'.Request::get('email').'%');
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like','%'.Request::get('email').'%');
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like','%'.Request::get('name').'%');
        }
    
        $return = $return->orderBy('id', 'desc');
    
        return $return->paginate(2);
    }

    static public function getStudent()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 3);
    
        $return = $return->orderBy('id', 'desc');
    
        return $return->paginate(50);
    }

    static public function getParent()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 4);
    
        $return = $return->orderBy('id', 'desc');
    
        return $return->paginate(50);
    }
    
    static public function getTeacher()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 2);
    
        $return = $return->orderBy('id', 'desc');
    
        return $return->paginate(50);
    }

    public function createdClasses()
    {
        return $this->hasMany(ClassName::class, 'created_by');
    }

    public function student()
    {
        return $this->hasOne(StudentMOdal::class);
    }

    public function parents()
    {
        return $this->hasMany(ParentModal::class, 'user_id');
    }
    
    public function parent()
    {
        return $this->hasOne(ParentModal::class, 'user_id');
    }

    public function assignedClasses()
    {
        return $this->hasMany(AssignClassTeacher::class, 'teacher_id');
    }

    // Assuming you have a role column or similar to differentiate teachers
    public function classes()
    {
        return $this->hasMany(AssignClassTeacher::class, 'teacher_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'created_by');
    }

    

    // teacher side show my class subject
    public function teacher()
    {
        return $this->hasOne(TeacherModal::class, 'user_id');
    }

    public function createdAssignClassTeachers()
    {
        return $this->hasMany(AssignClassTeacher::class, 'created_by');
    }
}
