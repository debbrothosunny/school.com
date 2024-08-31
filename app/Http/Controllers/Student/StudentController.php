<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Hash;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\StudentModal;
use App\Models\ClassName;
use App\Models\ParentModal;
use App\Models\AssignClassTeacher;
use Str;
use DB;

class StudentController extends Controller
{
    public function student_list(Request $request)
    {
        // Start the query builder for StudentModal with eager loading of the user relation
        $query = StudentModal::with('user'); 
        
        // Apply filters if they are present in the request
        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }
    
        if ($request->filled('admission_number')) {
            $query->where('admission_number', 'like', '%' . $request->admission_number . '%');
        }
    
        if ($request->filled('roll_number')) {
            $query->where('roll_number', 'like', '%' . $request->roll_number . '%');
        }
    
        if ($request->filled('first_name')) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }
    
        if ($request->filled('admission_date')) {
            $query->whereDate('admission_date', $request->admission_date);
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        // Order the results by created_at in descending order and paginate them
        $students = $query->orderBy('created_at', 'desc')->paginate(50);
    
        // Prepare data for the view
        $data = [
            'students' => $students,
            'header_title' => 'Student List'
        ];
    
        // Return the view with the students and additional data
        return view('admin.student_list', $data);
    }
    
    

       
    public function student_list_add()
    {   
        $classes = ClassName::where('status', 0)->orderBy('class_name', 'asc')->get();
        $parents = ParentModal::all();
        $data['header_title'] = 'Add New Class'; 
        return view('admin.student_list_add',compact('classes','data','parents'));
    }

    public function student_list_insert(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'admission_number' => 'required|unique:student_modals',
            'roll_number' => 'required|unique:student_modals',
            'class_id' => 'required|exists:class_names,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required|in:male,female,other',
            'd_o_b' => 'required|date',
            'caste' => 'required',
            'mobile_number' => 'required|unique:student_modals',
            'admission_date' => 'required|date',
            'blood_group' => 'nullable|string|max:255',
            'height' => 'nullable|numeric|max:999.99',
            'weight' => 'nullable|numeric|max:999.99',
            'status' => 'nullable|integer',
            'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif',
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 3, // Set the user_type explicitly to 3 for Student
        ]);
    
        // Initialize profile_pic filename variable
        $profilePicFilename = null;
    
        // Handle file upload
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = date('YmdHis') . Str::random(20) . '.' . $file->getClientOriginalExtension();
            
            // Save image to the specific directory
            $file->storeAs('profile', $filename, 'public');
            
            // Set the filename for storage in the database
            $profilePicFilename = $filename;
        }
    
        // Create the student
        StudentModal::create([
            'user_id' => $user->id,
            'admission_number' => $request->admission_number,
            'roll_number' => $request->roll_number,
            'class_id' => $request->class_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'd_o_b' => $request->d_o_b,
            'caste' => $request->caste,
            'religion' => $request->religion,
            'mobile_number' => $request->mobile_number,
            'admission_date' => $request->admission_date,
            'profile_pic' => $profilePicFilename,
            'blood_group' => $request->blood_group,
            'height' => $request->height,
            'weight' => $request->weight,
            'status' => $request->status ?? 0,
        ]);
    
        return redirect('admin/student_list')->with('success', 'Student created successfully');
    }

    public function edit($id)
    {
        $parents = ParentModal::all();
        $student = StudentModal::find($id);
        if ($student) {
            $classes = ClassName::where('status', 0)->orderBy('class_name', 'asc')->get();
            return view('admin.student_list_edit', compact('student','classes','parents'));
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        // Find the student
        $student = StudentModal::find($id);
        
        if ($student) {
            // Validate the request data
            $request->validate([
                'email' => 'nullable|email|unique:users,email,' . $student->user_id,
                'password' => 'nullable|min:6',
                'admission_number' => 'nullable|unique:student_modals,admission_number,' . $student->id,
                'roll_number' => 'nullable|unique:student_modals,roll_number,' . $student->id,
                'class_id' => 'nullable|exists:class_names,id',
                'first_name' => 'nullable',
                'last_name' => 'nullable',
                'gender' => 'nullable|in:male,female,other',
                'd_o_b' => 'nullable|date',
                'mobile_number' => 'nullable|unique:student_modals,mobile_number,' . $student->id,
                'admission_date' => 'nullable|date',
                'blood_group' => 'nullable|string|max:255',
                'height' => 'nullable|numeric|max:999.99',
                'weight' => 'nullable|numeric|max:999.99',
                'status' => 'nullable|integer',
                'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif',
            ]);
    
            // Update the user
            $user = User::find($student->user_id);
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
    
            // Handle profile picture upload
            if ($request->hasFile('profile_pic')) {
                // Delete old profile picture if it exists
                if ($student->profile_pic) {
                    Storage::disk('public')->delete('profile/' . $student->profile_pic);
                }
    
                // Upload the new profile picture
                $file = $request->file('profile_pic');
                $filename = date('YmdHis') . Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('profile', $filename, 'public');
                
                // Update the profile picture in the database
                $student->profile_pic = $filename;
            }
    
            // Update the student details
            $student->admission_number = $request->admission_number;
            $student->roll_number = $request->roll_number;
            $student->class_id = $request->class_id;
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->gender = $request->gender;
            $student->d_o_b = $request->d_o_b;
            $student->caste = $request->caste;
            $student->religion = $request->religion;
            $student->mobile_number = $request->mobile_number;
            $student->admission_date = $request->admission_date;
            $student->blood_group = $request->blood_group;
            $student->height = $request->height;
            $student->weight = $request->weight;
            $student->status = $request->status;
            $student->save();
    
            return redirect('admin/student_list')->with('success', 'Student updated successfully.');
        } else {
            return redirect('admin/student_list')->with('error', 'Student not found.');
        }
    }
    

    public function delete($id)
    {
        $student = StudentModal::find($id);
    
        if ($student) {
            // Delete the associated user record
            $user = User::find($student->user_id);
            if ($user) {
                $user->delete();
            }
    
            // Delete the profile picture from storage if it exists
            if ($student->profile_pic) {
                $profilePicPath = 'profile/' . $student->profile_pic; // Path within the storage directory
                if (Storage::disk('public')->exists($profilePicPath)) {
                    Storage::disk('public')->delete($profilePicPath);
                }
            }
    
            // Delete the student record
            $student->delete();
    
            return redirect('admin/student_list')->with('success', 'Student deleted successfully.');
        } else {
            return redirect('admin/student_list')->with('error', 'Student not found.');
        }
    }
    


    // Teacher Side To Show My Student  

    public function myStudent()
    {
        // Retrieve the authenticated teacher
        $teacher = Auth::user()->teacher;

        // Check if the teacher exists
        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher not found.');
        }

        // Retrieve classes taught by the teacher along with students
        $teacherClasses = AssignClassTeacher::with(['className.students'])
                                            ->where('teacher_id', $teacher->id)
                                            ->get()
                                            ->pluck('className')
                                            ->unique();
        
        return view('teacher.my_student', compact('teacherClasses'));
    }
    
}




