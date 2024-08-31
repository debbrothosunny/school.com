<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Hash;
use Auth;
use App\Models\User;
use App\Models\TeacherModal;
use App\Models\StudentModal;
use App\Models\ParentModal;

class UserController extends Controller
{
    public function adminPasswordForm()
    {   
        $data['header_title'] = 'Change Password'; 
        return view('admin.change_password',$data);
    }

    public function teacherPasswordForm()
    {   
        $data['header_title'] = 'Change Password'; 
        return view('teacher.change_password',$data);
    }

    public function parentPasswordForm()
    {   
        $data['header_title'] = 'Change Password'; 
        return view('parent.change_password',$data);
    }

    public function studentPasswordForm()
    {   
        $data['header_title'] = 'Change Password'; 
        return view('student.change_password',$data);
    }

    // Teacher Account
    public function MyAccount()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check the user type and fetch the appropriate record
            if ($user->user_type == 1) {
                // Find the admin record associated with the user
                $admin = User::find($user->id);

                // Check if the admin record exists
                if (!$admin) {
                    return redirect()->back()->with('error', 'Admin not found.');
                }

                // Pass the admin record to the view
                $data['admin'] = $admin;
                $data['header_title'] = 'My Account';

                return view('admin.my_account', $data);
            }  
            else if ($user->user_type == 2) {
                // Find the teacher record associated with the user
                $teacher = TeacherModal::where('user_id', $user->id)->first();

                // Check if the teacher record exists
                if (!$teacher) {
                    return redirect()->back()->with('error', 'Teacher not found.');
                }

                // Pass the teacher record to the view
                $data['teacher'] = $teacher;
                $data['header_title'] = 'My Account';

                return view('teacher.my_account', $data);
            } 
            else if ($user->user_type == 3) {
                // Find the student record associated with the user
                $student = StudentModal::where('user_id', $user->id)->first();

                // Check if the student record exists
                if (!$student) {
                    return redirect()->back()->with('error', 'Student not found.');
                }

            // Pass the student record to the view
            $data['student'] = $student;
            $data['header_title'] = 'My Account';

            return view('student.my_account', $data);
        }

        else if ($user->user_type == 4) {
            // Find the student record associated with the user
            $parent = ParentModal::where('user_id', $user->id)->first();

            // Check if the student record exists
            if (!$parent) {
                return redirect()->back()->with('error', 'Parent not found.');
            }

            // Pass the student record to the view
            $data['parent'] = $parent;
            $data['header_title'] = 'My Account';

            return view('parent.my_account', $data);
        } else {
            return redirect()->back()->with('error', 'Invalid user type.');
        }
    }



    
   // Update Student

    public function updateMyAccountStudent(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'd_o_b' => 'nullable|date',
            'caste' => 'nullable|string',
            'religion' => 'nullable|string',
            'mobile_number' => 'nullable|string|unique:student_modals,mobile_number,' . Auth::user()->id . ',user_id',
            'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif',
            'blood_group' => 'nullable|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
        ]);

        // Get the authenticated user and student
        $user = Auth::user();
        $student = StudentModal::where('user_id', $user->id)->first();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }

        // Update student information
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->d_o_b = $request->d_o_b;
        $student->caste = $request->caste;
        $student->religion = $request->religion;
        $student->mobile_number = $request->mobile_number;
        $student->blood_group = $request->blood_group;
        $student->height = $request->height;
        $student->weight = $request->weight;

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $student->profile_pic = $filename;
        }

        $student->save();
        $user->save();

        return redirect()->back()->with('success', 'Account updated successfully.');
    }



// Update Teacher

    public function updateMyAccount(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'qualification' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'd_o_b' => 'nullable|date',
            'c_address' => 'nullable|string',
            'p_address' => 'nullable|string',
            'religion' => 'nullable|string',
            'mobile_number' => 'nullable|string|unique:teacher_modals,mobile_number,' . Auth::user()->id . ',user_id',
            'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif',
            'experience' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . Auth::user()->id,
        ]);

        // Get the authenticated user and teacher
        $user = Auth::user();
        $teacher = TeacherModal::where('user_id', $user->id)->first();

        if (!$teacher) {
            return redirect()->back()->with('error', 'Teacher not found.');
        }

        // Update teacher information
        $teacher->name = $request->name;
        $teacher->marital_status = $request->marital_status;
        $teacher->qualification = $request->qualification;
        $teacher->gender = $request->gender;
        $teacher->d_o_b = $request->d_o_b;
        $teacher->c_address = $request->c_address;
        $teacher->p_address = $request->p_address;
        $teacher->religion = $request->religion;
        $teacher->mobile_number = $request->mobile_number;

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $teacher->profile_pic = $filename;
        }

        $teacher->experience = $request->experience;
        $teacher->blood_group = $request->blood_group;


        // Update user information
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $teacher->save();
        $user->save();

        return redirect()->back()->with('success', 'Account updated successfully.');
    }

    // Update Function Parent

    public function updateMyAccountParent(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'nullable|string',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:male,female,other',
            'mobile_number' => 'nullable|string|unique:parent_modals,mobile_number,' . Auth::user()->id . ',user_id',
            'occupation' => 'nullable|string',
            'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif',
        ]);

        // Get the authenticated user and parent
        $user = Auth::user();
        $parent = ParentModal::where('user_id', $user->id)->first();

        // Check if the parent record exists
        if (!$parent) {
            return redirect()->back()->with('error', 'Parent not found.');
        }

        // Update parent information
        $parent->name = $request->name;
        $parent->address = $request->address;
        $parent->gender = $request->gender;
        $parent->mobile_number = $request->mobile_number;
        $parent->occupation = $request->occupation;

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $parent->profile_pic = $filename;
        }

        $parent->save();

        return redirect()->back()->with('success', 'Account updated successfully.');
    }


   // Update Change Password For All user
    public function update_change_password(Request $request)
    {
        // Validate the form input
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
    
        // Check if the old password matches
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->withErrors(['old_password' => 'The old password does not match our records.']);
        }
    
        // Update the password
        $user = auth()->user();
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        // Return success response
        return back()->with('success', 'Password changed successfully.');
    }
}
