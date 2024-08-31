<?php

namespace App\Http\Controllers\AssignClassTeacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\AssignClassTeacher;
use App\Models\ClassName;
use App\Models\TeacherModal;
use App\Models\SubjectModel;
use File;
use Hash;
use Auth;


class AssignClassTeacherController extends Controller
{
    public function list(Request $request)
    {
        $assignments = AssignClassTeacher::with(['className', 'teacher', 'creator', 'subjects'])
            ->when($request->class_name, function ($query) use ($request) {
                $query->whereHas('className', function ($query) use ($request) {
                    $query->where('class_name', 'like', '%' . $request->class_name . '%');
                });
            })
            ->when($request->teacher_name, function ($query) use ($request) {
                $query->whereHas('teacher', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->teacher_name . '%');
                });
            })

            ->when($request->subject_name, function ($query) use ($request) {
                $query->whereHas('subjects', function ($query) use ($request) {
                    $query->where('subject_name', 'like', '%' . $request->subject_name . '%');
                });
            })

            ->when($request->created_at, function ($query) use ($request) {
                $query->whereDate('created_at', $request->created_at);
            })

            ->when($request->status, function ($query) use ($request) {
                if ($request->status == 0) {
                    // Filter assignments based on the status being 0 (active)
                    $query->where('status', 0);
                }
            })

            ->whereHas('className', function ($query) {
                // Ensure only active classes are shown (status 0)
                $query->where('status', 0);
            })
            ->whereHas('teacher', function ($query) {
                // Ensure only active teachers are shown (status 0)
                $query->where('status', 0);
            })
            ->paginate(10); // Use pagination for better performance

        $header_title = 'Assign Class Teacher';

        return view('admin.assign_class_teacher_list', compact('assignments', 'header_title'));
    }


    public function assign_class_teacher_list_add(Request $request)
    {
        // Retrieve active class names, active teachers, and active subjects for the form
        $classes = ClassName::where('status', 0)->get(); // Only active classes
        $teachers = TeacherModal::where('status', 0)->get(); // Only active teachers
        $subjects = SubjectModel::where('status', 0)->get(); // Only active subjects

        return view('admin.assign_class_teacher_list_add', compact('classes', 'teachers', 'subjects'));
    }

    public function assign_class_teacher_list_insert(Request $request)
    {
        // Validate the request data
        $request->validate([
            'class_id' => 'required|exists:class_names,id',
            'teacher_id' => 'required|exists:teacher_modals,id',
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subject_models,id',
            'status' => 'required|boolean',
        ]);

        // Check if the assignment already exists
        foreach ($request->subject_id as $subject_id) {
            $existingAssignment = AssignClassTeacher::where('class_id', $request->class_id)
                ->where('teacher_id', $request->teacher_id)
                ->where('subject_id', $subject_id)
                ->exists();

            if ($existingAssignment) {
                return redirect()->back()->with('error', 'This teacher is already assigned to this class for the selected subject.');
            }

            // Proceed to create the assignment if it doesn't exist
            $assignment = new AssignClassTeacher();
            $assignment->class_id = $request->class_id;
            $assignment->teacher_id = $request->teacher_id;
            $assignment->subject_id = $subject_id;
            $assignment->status = $request->status ?? 0; // Default to 0 if status is not provided
            $assignment->created_by = Auth::user()->id;
            $assignment->save();
        }

        return redirect('admin/assign_class_teacher_list')->with('success', 'Subject(s) successfully assigned to class');
    }

    public function edit($id)
    {
        $assignment = AssignClassTeacher::with('subjects')->findOrFail($id);

       
        $classes = ClassName::all();
        $teachers = TeacherModal::all();
        $subjects = SubjectModel::all();

        return view('admin.assign_class_teacher_list_edit', compact('assignment', 'classes', 'teachers', 'subjects'));
    }

    // Handle the update request
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'class_id' => 'nullable|exists:class_names,id',
            'teacher_id' => 'nullable|exists:teacher_modals,id',
            'subject_id' => 'nullable|array',
            'subject_id.*' => 'exists:subject_models,id',
            'status' => 'nullable|boolean',
        ]);
    
    
        // Find the existing AssignClassTeacher record
        $assignment = AssignClassTeacher::findOrFail($id);
        
        // Assign fields
        $assignment->class_id = $request->class_id;
        $assignment->teacher_id = $request->teacher_id;
        $assignment->status = $request->status;
        $assignment->created_by = auth()->user()->id;
        
        // Sync subjects
        $assignment->subjects()->sync($request->subject_id);
    
        // Save the updated assignment
        $assignment->save();
    
        // Redirect with success message
        return redirect()->route('admin.assign_class_teacher_list')->with('success', 'Data updated successfully.');
    }

    public function delete($id)
    {
        // Find the AssignClassTeacher record
        $assignment = AssignClassTeacher::findOrFail($id);

        // Delete the record
        $assignment->delete();

        // Redirect with success message
        return redirect()->route('admin.assign_class_teacher_list')->with('success', 'Data deleted successfully.');
    }




    // Teacher Side 
    public function myClassSubject()
    {
        $user = Auth::user();
        $teacher = $user->teacher;
    
        // Debugging: Check the authenticated user and teacher relationship
        if (!$teacher) {
            // Log the user details for debugging
            \Log::error('Teacher not found for user', ['user_id' => $user->id, 'user_name' => $user->name]);
    
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher not found.');
        }
    
        // Fetch assignments for the authenticated teacher with relationships
        $assignments = AssignClassTeacher::where('teacher_id', $teacher->id)
            ->with(['className', 'subject'])
            ->get();
    
        // Return view with assignments
        return view('teacher.my_class_subject', compact('assignments'));
    }

}
