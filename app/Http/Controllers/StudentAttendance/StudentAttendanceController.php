<?php

namespace App\Http\Controllers\StudentAttendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassName;
use App\Models\StudentModal;
use App\Models\StudentAttendance;
use Auth;

class StudentAttendanceController extends Controller
{
    public function index()
    {
        // Retrieve only active classes
        $classes = ClassName::where('status', 0)->get();
    
        return view('admin.student_attendance', compact('classes'));
    }

    public function showAttendance(Request $request)
    {
        $class_id = $request->query('class_id');
        $attendance_date = $request->query('attendance_date');

        $students = StudentModal::where('class_id', $class_id)->get();

        // Fetch existing attendance records for the class and date
        $attendances = StudentAttendance::where('class_id', $class_id)
                                        ->where('attendance_date', $attendance_date)
                                        ->get()
                                        ->keyBy('student_id');

        $classes = ClassName::all();

        return view('admin.student_attendance', compact('students', 'class_id', 'attendance_date', 'attendances', 'classes'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class_names,id',
            'attendance_date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'in:present,absent,late,half_day',
        ]);

        $class_id = $request->input('class_id');
        $attendance_date = $request->input('attendance_date');
        $attendanceData = $request->input('attendance');

        // Map attendance types to integers
        $attendanceTypes = [
            'present' => 1,
            'absent' => 2,
            'late' => 3,
            'half_day' => 4,
        ];

        foreach ($attendanceData as $student_id => $attendance_type) {
            StudentAttendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'class_id' => $class_id,
                    'attendance_date' => $attendance_date,
                ],
                [
                    'attendance_type' => $attendanceTypes[$attendance_type], // Store the integer value
                ]
            );
        }

        return redirect()->back()->with('success', 'Attendance saved successfully.');
    }


    public function attendanceReport(Request $request)
    {
        // Retrieve only active classes
        $classes = ClassName::where('status', 0)->get();
    
        $class_id = $request->input('class_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $students = [];
        $attendances = [];
    
        if ($class_id && $start_date && $end_date) {
            $students = StudentModal::where('class_id', $class_id)->get();
    
            $attendances = StudentAttendance::where('class_id', $class_id)
                ->whereBetween('attendance_date', [$start_date, $end_date])
                ->get()
                ->groupBy('student_id');
        }
    
        return view('admin.attendance_report', compact('classes', 'class_id', 'start_date', 'end_date', 'students', 'attendances'));
    }




    // teacher side to show student attendance

    public function teacherStudentAttendanceReport(Request $request)
    {
        $teacher = Auth::user()->teacher;
        $classes = ClassName::all();
    
        $class_id = $request->input('class_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $students = [];
        $attendances = [];
        $class_name = '';
    
        if ($class_id && $start_date && $end_date) {
            $students = StudentModal::where('class_id', $class_id)->get();
    
            $attendances = StudentAttendance::where('class_id', $class_id)
                ->whereBetween('attendance_date', [$start_date, $end_date])
                ->get()
                ->groupBy('student_id');
    
            $class = ClassName::find($class_id);
            $class_name = $class ? $class->class_name : '';
        }
    
        return view('teacher.student_attendance_report', compact('classes', 'class_id', 'start_date', 'end_date', 'students', 'attendances', 'class_name'));
    }




    // Student side to show student attendance
    public function myAttendance(Request $request)
    {
        $student = Auth::user()->student;
        $student_id = $student->id;
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $attendances = [];
    
        if ($start_date && $end_date) {
            $attendances = StudentAttendance::where('student_id', $student_id)
                ->whereBetween('attendance_date', [$start_date, $end_date])
                ->get()
                ->groupBy('attendance_date');
        }
    
        return view('student.my_attendance', compact('student', 'start_date', 'end_date', 'attendances'));
    }


}
