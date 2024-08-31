<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use File;
use Hash;
use Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Password;
use Validator;
use App\Models\User;
use App\Models\Setting;



class AdminController extends Controller
{

    public function login()
    {
    // dd(Hash::make(123456));
    if(!empty(Auth::check()))
    {
        if(Auth::user()->user_type == 1)
        {
            return redirect('admin/dashboard');
        }
    
        else if(Auth::user()->user_type == 2)
        {
        return redirect('teacher/dashboard');
        }
        else if(Auth::user()->user_type == 3)
        {
        return redirect('student/dashboard');
        }
        else if(Auth::user()->user_type == 4)
        {
        return redirect('parent/dashboard');
        }
    }
    return view('admin.login');
    }
    

    public function AuthLogin (Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
        
            else if(Auth::user()->user_type == 2)
            {
            return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
            return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4)
            {
            return redirect('parent/dashboard');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Please enter correct email and password');
        }
    }


    public function logout()
    {
        Auth::logout();
      return redirect(url(''));
    }

    public function forgetpassword()
    {
        return view('admin.forget');
    }

    public function PostForgetPassword(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();

        // Debugging: Check the user object
        if (!$user) {
            return redirect()->back()->with('error', "Email not found in the system.");
        }

        // Debugging: If user exists, check if remember_token is being assigned properly
        $user->remember_token = Str::random(30);
        $user->save();

        // Debugging: Dump the token and user data to verify correctness
        // dd($user);

        // Send the password reset email
        Mail::to($user->email)->send(new ForgotPasswordMail($user));

        // Return with a success message
        return redirect()->back()->with('success', 'Password reset link has been sent to your email address.');
    }


    

    public function admin_list()
    {
        $getRecord = User::getAdmin();
        $header_title = 'Admin List'; 
        $setting = Setting::first();

        return view('admin.admin_list', compact('getRecord', 'header_title', 'setting'));
    }

    public function admin_list_add()
    {
        return view('admin.admin_list_add');
    }


    public function insert(Request $request)
    {
    $user = new User;
    $user->name = trim($request->name);
    $user->email = trim($request->email);
    $user->password = Hash::make($request->password);
    $user->user_type = 1;
    $user->save();
    return redirect('admin/admin_list')->with('success', 'Admin Successfully Create');
    }
    
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id); 
        if (!empty($data['getRecord'])) 
        { 
            $data["header_Title"] = "Edit Admin"; 
            return view('admin.edit', $data);
        } else {
            abort(404); 
        }
    }
 
    public function update($id, Request $request)
    {
        // Retrieve the user by ID
        $user = User::getSingle($id);
        
        // Update the user's details
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        
        // Update the password only if it's provided
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
    
        // Save the updated user
        $user->save();
        
        // Redirect with a success message
        return redirect('admin/admin_list')->with('success', 'Admin successfully updated');
    }

    public function delete($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect back to the admin list with a success message
        return redirect('admin/admin_list')->with('success', "Admin successfully deleted");
    }

}
 