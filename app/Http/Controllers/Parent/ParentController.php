<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Hash;
use Auth;
use App\Models\User;
use App\Models\ParentModal;
use App\Models\StudentModal;
use Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ParentController extends Controller
{
    public function parent_list(Request $request)
    {
        // Start the query builder for ParentModal
        $query = ParentModal::with('user');
    
        // Apply filters if they are present in the request
        if (!empty($request->get('search'))) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('address', 'like', '%' . $request->search . '%')
                  ->orWhere('mobile_number', 'like', '%' . $request->search . '%');
            });
        }
    
        // Paginate the results with 10 records per page
        $parents = $query->orderBy('created_at', 'desc')->paginate(50);
    
        // Prepare additional data for the view
        $data['getRecord'] = User::getParent();
        $data['header_title'] = 'Parent List'; 
    
        // Return the view with the paginated parents and additional data
        return view('admin.parent_list', $data, compact('parents'));
    }


    public function parent_list_add()
    {   
        $students = StudentModal::all();
        $data['header_title'] = 'Add New Class'; 
        return view('admin.parent_list_add',compact('data','students'));
    }
    public function parent_list_insert(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'name' => 'required',
            'address' => 'required',
            'status' => 'nullable|integer',
            'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif',
            'gender' => 'required|in:male,female,other',
            'mobile_number' => 'required|unique:parent_modals',
            'occupation' => 'required',
            'student_id' => 'required|exists:student_modals,id'
        ]);
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 4, // Set the user_type explicitly to 4 for Parent
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
    
        // Create the parent
        ParentModal::create([
            'user_id' => $user->id,
            'student_id' => $request->student_id,
            'name' => $request->name,
            'address' => $request->address,
            'status' => $request->status,
            'profile_pic' => $profilePicFilename,
            'gender' => $request->gender,
            'mobile_number' => $request->mobile_number,
            'occupation' => $request->occupation,
        ]);
    
        return redirect('admin/parent_list')->with('success', 'Parent created successfully');
    }

    public function edit($id)
    {
        $parent = ParentModal::find($id);
        $students = StudentModal::all(); // Fetch all students
        if ($parent) {
            return view('admin.parent_list_edit', compact('parent','students'));
        } else {
            return redirect('admin/parent_list')->with('error', 'Parent not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $parent = ParentModal::find($id);
        
        if ($parent) {
            // Validate the request data
            $request->validate([
                'email' => 'required|email|unique:users,email,' . $parent->user_id,
                'password' => 'nullable|min:6',
                'name' => 'required',
                'address' => 'required',
                'status' => 'nullable|integer',
                'profile_pic' => 'nullable|image|max:5120|mimes:jpeg,png,jpg,gif',
                'gender' => 'required|in:male,female,other',
                'mobile_number' => 'required|unique:parent_modals,mobile_number,' . $parent->id,
                'occupation' => 'required',
            ]);
    
            // Update the user
            $user = User::find($parent->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
    
             // Handle profile picture upload
             if ($request->hasFile('profile_pic')) {
                // Delete old profile picture if it exists
                if ($parent->profile_pic) {
                    Storage::disk('public')->delete('profile/' . $parent->profile_pic);
                }
    
                // Upload the new profile picture
                $file = $request->file('profile_pic');
                $filename = date('YmdHis') . Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->storeAs('profile', $filename, 'public');
                
                // Update the profile picture in the database
                $parent->profile_pic = $filename;
            }
    
            // Update the parent
            $parent->name = $request->name;
            $parent->address = $request->address;
            $parent->status = $request->status;
            $parent->gender = $request->gender;
            $parent->mobile_number = $request->mobile_number;
            $parent->occupation = $request->occupation;
            $parent->save();
    
            return redirect('admin/parent_list')->with('success', 'Parent updated successfully.');
        } else {
            return redirect('admin/parent_list')->with('error', 'Parent not found.');
        }
    }
    

    public function delete($id)
    {
        // Find the parent by ID
        $parent = ParentModal::find($id);
        
        if ($parent) {
            // Find the associated user
            $user = User::find($parent->user_id);
    
            // Delete the profile picture if it exists
            if ($parent->profile_pic) {
                Storage::disk('public')->delete($parent->profile_pic);
            }
    
            // Delete the parent record
            $parent->delete();
    
            // Delete the associated user
            if ($user) {
                $user->delete();
            }
    
            return redirect('admin/parent_list')->with('success', 'Parent and associated user deleted successfully');
        } else {
            return redirect('admin/parent_list')->with('error', 'Parent not found');
        }
    }
    

    // public function myStudent($id)
    // {
    //     // Find the parent and load the associated student
    //     $parent = ParentModal::with('student')->findOrFail($id);

    //     // Get the student information
    //     $student = $parent->student;

    //     // Return the view with the parent and student data
    //     return view('admin.my_student', compact('parent', 'student'));
    // }


    public function search(Request $request)
    {
        $search = $request->input('search');

        // Start the query builder for ParentModal
        $query = ParentModal::query();

        // Apply filters based on search input
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('address', 'like', "%{$search}%")
                ->orWhere('mobile_number', 'like', "%{$search}%");
            });
        }

        // Paginate the results
        $parents = $query->orderBy('created_at', 'desc')->paginate(10);

        // Set the header title
        $data['header_title'] = 'Parent List';

        // Return the view with the paginated parents and additional data
        return view('admin.parent_list', $data, compact('parents'));
    }


   // Parent Side to show my Student
   public function myStudents()
   {
       // Retrieve the authenticated parent
       $parent = Auth::user()->parent;
   
       // Check if the parent exists
       if ($parent) {
           // Load the associated students
           $students = $parent->students;
   
           // Pass the parent and students variables to the view
           return view('parent.parent_student', compact('parent', 'students'));
       } else {
           // If the parent does not exist, return a view indicating the error
           return redirect()->route('parent.dashboard')->with('error', 'Parent not found.');
       }
   }  
    
}

