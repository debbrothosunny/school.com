<?php

namespace App\Http\Controllers\HomeWork;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassName;
use App\Models\SubjectModel;
use App\Models\HomeWork;
use App\Models\TeacherModal;
use App\Models\StudentModal;
use App\Models\StudentHomeworkSubmission;
use Auth;
use Storage;

class HomeWorkController extends Controller
{
    public function index()
    {
        // Retrieve only active classes and teachers
        $classNames = ClassName::where('status', 0)->get();
        $teachers = TeacherModal::where('status', 0)->get();

        // Retrieve all homework with related models
        $homeworks = HomeWork::with(['className', 'subject', 'teacher'])->get();

        return view('admin.homework', compact('classNames', 'homeworks', 'teachers'));
    }
    
    public function fetchHomeWorkSubjects(Request $request)
    {
        $classId = $request->class_id;
    
        // Fetch subjects related to the selected class ID using the relationship
        $subjects = SubjectModel::whereHas('assignClassTeachers', function ($query) use ($classId) {
            $query->where('class_id', $classId);
        })->pluck('subject_name', 'id');
    
        return response()->json($subjects);
    }
   
    public function saveHomeWork(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:class_names,id',
            'subject_id' => 'required|exists:subject_models,id',
            'teacher_id' => 'required|exists:teacher_modals,id',
            'homework_date' => 'required|date',
            'submission_date' => 'required|date',
            'description' => 'required',
            'document' => 'required|file|mimes:pdf,doc,docx', // Update this based on your requirements
        ]);
    
        // Handle file upload
        if ($request->hasFile('document')) {
            $filePath = $request->file('document')->store('documents', 'public');
            $validated['document'] = $filePath;
        }
    
        HomeWork::create($validated);
    
        return redirect()->back()->with('success', 'Homework created successfully.');
    }
    
    public function download($id)
    {
        $homework = HomeWork::findOrFail($id);
    
        // Ensure file exists
        if (Storage::disk('public')->exists($homework->document)) {
            return Storage::disk('public')->download($homework->document);
        }
    
        return redirect()->back()->with('error', 'File not found.');
    }
    
    public function delete($id)
    {  
        // Find the homework by its ID
        $homework = HomeWork::findOrFail($id);
    
        // Delete the homework
        $homework->delete();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Homework deleted successfully.');
    }




        // Teacher Side To show HomeWork

        public function teacherHomework()
        {
            $teacherId = Auth::user()->teacher->id;
            $homeworks = HomeWork::where('teacher_id', $teacherId)->with(['className', 'subject', 'teacher'])->get();
            
            // Fetch only classes assigned to the teacher
            $classNames = ClassName::whereHas('assignClassTeachers', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->get();

            // Fetch only subjects assigned to the teacher's classes
            $subjects = SubjectModel::whereHas('assignClassTeachers', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->get();

            // Fetch only teachers assigned to the teacher's classes
            $teachers = TeacherModal::whereHas('assignClassTeachers', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })->get();

            return view('teacher.teacher_home_work', compact('homeworks', 'classNames', 'subjects', 'teachers'));
        }


    // Student Side To show HomeWork
        public function studentHomeWork()
        {
            $studentId = Auth::user()->student->id;
    
            // Fetch student with assigned class and subjects
            $student = StudentModal::with('className.subjects')->find($studentId);
    
            // Fetch homeworks for the student's class
            $homeworks = HomeWork::where('class_id', $student->class_id)->get();
    
            return view('student.student_home_work', compact('homeworks', 'student'));
        }


        public function create($homeworkId)
        {
            $homework = HomeWork::findOrFail($homeworkId);
        
            return view('student.submit_homework', compact('homework'));
        }


        public function store(Request $request)
        {
            // Validate the request data
            $validated = $request->validate([
                'homework_id' => 'required|exists:home_works,id',
                'document' => 'required|file|mimes:pdf,doc,docx',
                'description' => 'nullable|string'
            ]);
        
            // Handle file upload
            if ($request->hasFile('document')) {
                try {
                    $filePath = $request->file('document')->store('student_homework', 'public');
                    $validated['document'] = $filePath;
                } catch (\Exception $e) {
                    \Log::error('Error uploading document: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Error uploading document.');
                }
            } else {
                return redirect()->back()->with('error', 'Document file is required.');
            }
        
            // Get the student's ID
            $studentId = Auth::user()->student->id;
        
            // Create the student homework submission
            try {
                $validated['student_id'] = $studentId;
                StudentHomeworkSubmission::create($validated);
                return redirect()->route('student.student_home_work')->with('success', 'Homework submitted successfully.');
            } catch (\Exception $e) {
                \Log::error('Error submitting homework: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while submitting the homework. Please try again.');
            }
        }


    // My submitted Home Work

    public function mySubmittedHomework()
    {
        $studentId = Auth::user()->student->id;

        // Fetch the student's submitted homework
        $submittedHomework = StudentHomeworkSubmission::with('homework.subject', 'homework.className')
                                ->where('student_id', $studentId)
                                ->get();

        return view('student.my_submitted_homework', compact('submittedHomework'));
    }


    // admin side to show student sumitted homewrok

    public function adminSubmittedHomework()
    {
        $submittedHomework = StudentHomeworkSubmission::with(['homework.subject', 'homework.className', 'student'])
                                ->get();

        return view('admin.admin_submitted_homework', compact('submittedHomework'));
    }


    // Teacher side to show student sumitted homewrok

    public function teacherSubmittedHomework()
    {
        $teacherId = Auth::user()->teacher->id;

        $submittedHomework = StudentHomeworkSubmission::with(['homework.subject', 'homework.className', 'student'])
                                ->whereHas('homework', function ($query) use ($teacherId) {
                                    $query->where('teacher_id', $teacherId);
                                })
                                ->get();

        return view('teacher.teacher_submitted_homework', compact('submittedHomework'));
    }

}



