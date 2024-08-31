<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Hash;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\TeacherModal;
use App\Models\AssignClassTeacher;
use App\Models\TimeTable;
use Str;


class TeacherController extends Controller
{
    public function teacher_list(Request $request)
    {
        // Get the search input from the request
        $search = $request->input('search');
    
        // Start the query builder for TeacherModal
        $query = TeacherModal::query();
    
        // If search input is present, apply filters on relevant columns
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('qualification', 'like', "%{$search}%")
                  ->orWhere('mobile_number', 'like', "%{$search}%")
                  ->orWhere('d_o_j', 'like', "%{$search}%"); // Assuming 'd_o_j' is the date of joining
            });
        }
    
        // Order the results by 'created_at' in descending order and paginate
        $teachers = $query->orderBy('created_at', 'desc')->paginate(50);
    
        // Pass the header title and teachers data to the view
        $data['header_title'] = 'Teacher List'; 
    
        return view('admin.teacher_list', $data, compact('teachers'));
    }

    public function teacher_list_add()
    {
        
        $data['header_title'] = 'Add New Teacher'; 
        return view('admin.teacher_list_add',$data);
    }
    
    public function teacher_list_insert(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'name' => 'required|string|max:255',
            'marital_status' => 'required|string',
            'qualification' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'd_o_b' => 'required|date',
            'c_address' => 'nullable|string',
            'p_address' => 'nullable|string',
            'religion' => 'nullable|string',
            'mobile_number' => 'required|unique:teacher_modals',
            'd_o_j' => 'required|date',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'experience' => 'nullable|string',
            'note' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);
    
        // Hash the password
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['user_type'] = 2; // Set the user_type explicitly to 2 for teacher
    
        // Handle file upload and database storage
        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = date('YmdHi') . $file->getClientOriginalName();
    
            // Save image to the specific directory
            $filePath = $file->storeAs('profile', $filename, 'public');
    
            // Store filename in the database
            $validatedData['profile_pic'] = $filename;
        }
    
        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'user_type' => $validatedData['user_type'],
        ]);
    
        // Check if the user creation was successful
        if ($user) {
            // Create the teacher
            TeacherModal::create([
                'user_id' => $user->id,
                'name' => $validatedData['name'],
                'marital_status' => $validatedData['marital_status'],
                'qualification' => $validatedData['qualification'],
                'gender' => $validatedData['gender'],
                'd_o_b' => $validatedData['d_o_b'],
                'c_address' => $validatedData['c_address'],
                'p_address' => $validatedData['p_address'],
                'religion' => $validatedData['religion'],
                'mobile_number' => $validatedData['mobile_number'],
                'd_o_j' => $validatedData['d_o_j'],
                'profile_pic' => $validatedData['profile_pic'] ?? null, // Assign the profile_pic if it exists
                'experience' => $validatedData['experience'],
                'note' => $validatedData['note'],
                'blood_group' => $validatedData['blood_group'],
                'status' => $validatedData['status'] ?? 0,
            ]);
    
            return redirect('admin/teacher_list')->with('success', 'Teacher Created Successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create user');
        }
    }
    
    


    public function edit($id)
    {
        $teacher = TeacherModal::find($id);
        if ($teacher) {
            return view('admin.teacher_list_edit', compact('teacher'));
        } else {
            return redirect('admin/teacher_list')->with('error', 'Teacher not found.');
        }
    }
    
    public function update(Request $request, $id)
    {
        // Find the teacher by ID
        $teacher = TeacherModal::find($id);
    
        // If the teacher exists
        if ($teacher) {
            // Validate the request data
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $teacher->user_id,
                'password' => 'nullable|min:6',
                'name' => 'required|string',
                'marital_status' => 'required|string',
                'qualification' => 'required|string',
                'gender' => 'required|in:male,female,other',
                'd_o_b' => 'required|date',
                'c_address' => 'nullable|string',
                'p_address' => 'nullable|string',
                'religion' => 'nullable|string',
                'mobile_number' => 'required|string|unique:teacher_modals,mobile_number,' . $teacher->id,
                'd_o_j' => 'required|date',
                'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif',
                'experience' => 'nullable|string',
                'note' => 'nullable|string',
                'blood_group' => 'nullable|string',
                'status' => 'nullable|boolean',
            ]);
    
            // Update the teacher's information
            $teacher->update([
                'name' => $request->name,
                'marital_status' => $request->marital_status,
                'qualification' => $request->qualification,
                'gender' => $request->gender,
                'd_o_b' => $request->d_o_b,
                'c_address' => $request->c_address,
                'p_address' => $request->p_address,
                'religion' => $request->religion,
                'mobile_number' => $request->mobile_number,
                'd_o_j' => $request->d_o_j,
                'experience' => $request->experience,
                'note' => $request->note,
                'blood_group' => $request->blood_group,
                'status' => $request->status ?? 0,
            ]);
    
            // Update the user
            $user = User::find($teacher->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
    
            // Handle profile picture upload
            if ($request->hasFile('profile_pic')) {
                // Delete the old profile picture if it exists
                if ($teacher->profile_pic && file_exists(public_path('storage/profile/' . $teacher->profile_pic))) {
                    unlink(public_path('storage/profile/' . $teacher->profile_pic));
                }
    
                $file = $request->file('profile_pic');
                $filename = date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('profile', $filename, 'public');
    
                // Update the profile picture filename in the database
                $teacher->profile_pic = $filename;
                $teacher->save();
            }
    
            // Redirect back with success message
            return redirect('admin/teacher_list')->with('success', 'Teacher information updated successfully.');
        } else {
            // If teacher not found, redirect back with error message
            return redirect()->back()->with('error', 'Teacher not found.');
        }
    }
    
    public function delete($id)
    {
        // Find the teacher by id
        $teacher = TeacherModal::find($id);
    
        // Check if the teacher exists
        if (!$teacher) {
            return redirect()->back()->with('error', 'Teacher not found.');
        }
    
        // Soft delete the teacher
        $teacher->delete();
    
        return redirect()->back()->with('success', 'Teacher deleted successfully.');
    }


    // teacher side to show my class time table

    public function viewClassTimetable($id)
    {
        // Retrieve the authenticated teacher  
        $teacher = Auth::user()->teacher;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')->with('error', 'Teacher not found.');
        }

        // Find the class assignment by ID and ensure it belongs to the authenticated teacher
        $assignment = AssignClassTeacher::with(['className', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->where('id', $id)
            ->first();

        if (!$assignment) {
            return redirect()->route('teacher.dashboard')->with('error', 'Assignment not found or you do not have permission to view this timetable.');
        }

        // Get the timetable for the assigned class and subject
        $timeTables = TimeTable::with(['className', 'subject'])
            ->where('class_id', $assignment->class_id)
            ->where('subject_id', $assignment->subject_id)
            ->get();

        return view('teacher.my_class_time_table', compact('timeTables'));
    }
    
}
