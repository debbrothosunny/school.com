<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentModal;
use App\Models\Teachermodal;
use App\Models\ParentModal;
use App\Models\ClassName;
use App\Models\SubjectModel;
use App\Models\Exam;
use App\Models\NoticeBoard;
use App\Models\StudentFees;
use App\Models\AssignClassTeacher;
use App\Models\ExamSchedule;
use App\Models\StudentAttendance;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller

{
    public function dashboard()
    {  
        $data['header_title'] = 'Dashboard'; 
        
    if (Auth::user()->user_type == 1) {
        // Combine all counts into one query using subqueries
        $totals = DB::table('student_modals')
            ->selectRaw('(SELECT COUNT(*) FROM student_modals) as total_students')
            ->selectRaw('(SELECT COUNT(*) FROM teacher_modals) as total_teachers')
            ->selectRaw('(SELECT COUNT(*) FROM parent_modals) as total_parents')
            ->selectRaw('(SELECT COUNT(*) FROM class_names) as total_classes')
            ->selectRaw('(SELECT COUNT(*) FROM subject_models) as total_subjects')
            ->selectRaw('(SELECT COUNT(*) FROM exams) as total_exams')
            ->first();
        
        // Calculate today's received payment
        $today = now()->startOfDay();
        $todayReceivedPayment = StudentFees::where('created_at', '>=', $today)->sum('paid_amount');

        // Calculate all-time received payment
        $allTimeReceivedPayment = StudentFees::sum('paid_amount');

        // Calculate this month's received payment
        $startOfMonth = now()->startOfMonth();
        $monthReceivedPayment = StudentFees::where('created_at', '>=', $startOfMonth)->sum('paid_amount');

        // Extract counts from the $totals object
        $totalStudents = $totals->total_students;
        $totalTeachers = $totals->total_teachers;
        $totalParents = $totals->total_parents;
        $totalClasses = $totals->total_classes;
        $totalSubjects = $totals->total_subjects;
        $totalExams = $totals->total_exams;

        return view('admin.dashboard', compact(
            'totalStudents', 'totalTeachers', 'data', 'totalParents', 
            'totalClasses', 'totalSubjects', 'totalExams', 
            'todayReceivedPayment', 'allTimeReceivedPayment', 
            'monthReceivedPayment'
        ));
    }

        
        elseif (Auth::user()->user_type == 2) {

            $teacher = Auth::user()->teacher;
        
            if (!$teacher) {
                return redirect()->route('teacher.dashboard')->with('error', 'Teacher not found.');
            }
        
            $teacherId = $teacher->id;
        
            // Fetch classes and students count in a single query
            $teacherClassesAndStudents = AssignClassTeacher::with(['className' => function ($query) {
                $query->withCount('students');
            }])
            ->where('teacher_id', $teacherId)
            ->get();
        
            // Calculate total students and classes
            $teacherStudents = $teacherClassesAndStudents->sum('className.students_count');
            $teacherClasses = $teacherClassesAndStudents->count();
        

 
        
            // Fetch notice board count where message is directed to parents (user_type = 4)
            $getRecord = NoticeBoard::whereHas('NoticeBoardMessage', function ($query) {
                $query->where('message_to', 4); // Assuming 4 is the ID for parents
            })->count();
        
            return view('teacher.dashboard', compact('teacherClasses', 'teacherStudents', 'getRecord'));
        }
    
     


        elseif (Auth::user()->user_type == 3) {
            $student = Auth::user()->student;
    
            if (!$student) {
                return redirect()->route('student.dashboard')->with('error', 'Student not found.');
            }
    
            $studentId = $student->id;
    
            $subjects = $student->className->subjects->count(); // Assuming a student has a class and a class has subjects
            $examSchedules = ExamSchedule::where('class_id', $student->class_id)->count(); // Assuming class_id is used for schedules
            $attendances = StudentAttendance::where('student_id', $studentId)->count();
            $fees = StudentFees::where('student_id', $studentId)->count();
            $notices = NoticeBoard::whereHas('NoticeBoardMessage', function ($query) {
                $query->where('message_to', 3); // Assuming 3 is the ID for students
            })->count();
    
            return view('student.dashboard', compact('data', 'subjects', 'examSchedules', 'attendances', 'fees', 'notices'));
        }
        
        
        elseif (Auth::user()->user_type == 4) {
            $parent = Auth::user()->parent; // Assuming you have a relationship to fetch parent details
        
            if (!$parent) {
                return redirect()->route('parent.dashboard')->with('error', 'Parent not found.');
            }
        
            // Assuming you have a relationship to fetch the students of the parent
            $students = $parent->students; 
        
            if ($students->isEmpty()) {
                return redirect()->route('parent.dashboard')->with('error', 'No students associated with this parent.');
            }
        
            // Assuming you want to get total fees and notices related to the parent
            $fees = $students->sum(function ($student) {
                return StudentFees::where('student_id', $student->id)->sum('total_amount'); // Summing up fees for all associated students
            });
        
            $notices = NoticeBoard::whereHas('NoticeBoardMessage', function ($query) {
                $query->where('message_to', 4); // Assuming 4 is the ID for parents
            })->count();
        
            // Prepare the data array
            $data = [
                'fees' => $fees,
                'notices' => $notices,
            ];
        
            return view('parent.dashboard', compact('data', 'fees', 'notices'));
        }
    }



    // School Setting 
    public function school_name()
    {
        $settings = Setting::all();
        return view('admin.setting', compact('settings'));
    }

    public function school_name_create()
    {
        return view('admin.setting_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'copyright' => 'nullable|string|max:255', // Add validation for copyright
        ]);
    
        Setting::create($request->only('school_name', 'copyright'));
    
        return redirect()->route('admin.setting')->with('success', 'School created successfully.');
    }

    public function school_name_edit(Setting $setting)
    {
        return view('admin.setting_edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'copyright' => 'nullable|string|max:255', // Add validation for copyright
        ]);
    
        $setting->update($request->only('school_name', 'copyright'));
    
        return redirect()->route('admin.setting')->with('success', 'School updated successfully.');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
    
        return redirect()->route('admin.setting')->with('success', 'School deleted successfully.');
    }


    public function copyRight()
        {
            $setting = Setting::first(); // Assuming you have only one settings record
            return view('backend.layouts.app', compact('setting'));
        }

}

