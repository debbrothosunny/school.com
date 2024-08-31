<?php

namespace App\Http\Controllers\Class;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassName;
use File;
use Hash;
use Auth;

class ClassController extends Controller
{
    public function classList(Request $request)
    {
        // Initialize the query without eager loading
        $query = ClassName::query();
    
        // Apply date filter if provided
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->get('date'));
        }
    
        // Apply class name filter if provided
        if ($request->filled('class_name')) {
            $query->where('class_name', 'like', '%' . $request->get('class_name') . '%');
        }
    
        // Order by class_names.id in descending order and paginate results
        $classes = $query->orderByDesc('id')->paginate(50);
    
        $data['header_title'] = 'Class List';
    
        // Return view with data and classes
        return view('admin.class_list', compact('data', 'classes'));
    }
    

    public function classListAdd()
    {
        $data['header_title'] = 'Add New Class';
        return view('admin.class_list_add', $data);
    }

    public function insert(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'class_name' => 'required|string|max:255',
            'amount' => 'required|numeric|max:999999.99',
            'status' => 'required|boolean', // Assuming status is boolean
        ]);

        $class = new ClassName();

        $class->class_name = $request->class_name;
        $class->amount = $request->amount;
        $class->status = $request->status;
        $class->created_by = Auth::user()->id; // Assuming using Laravel's auth helper
        $class->save();

        return redirect()->route('admin.class_list_add')->with('success', 'Class Successfully Created');
    }

    public function edit($id)
    {
        $class = ClassName::findOrFail($id);
        $data['class'] = $class;
        $data['header_title'] = 'Edit Class';
        return view('admin.class_list_edit', $data);
    }

    public function update(Request $request,$id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'class_name' => 'required|string|max:255',
            'amount' => 'required|numeric|max:999999.99',
            'status' => 'required|boolean', // Assuming status is boolean
        ]);
    
        $class = ClassName::findOrFail($id);
    
        $class->class_name = $request->class_name;
        $class->amount = $request->amount;
        $class->status = $request->status;
        $class->save();
    
        return redirect('admin/class_list')->with('success', 'Class successfully updated.');
    }
    

    public function delete($id)
    {
        $class = ClassName::findOrFail($id);

        $class->delete();

        return redirect()->back()->with('success', 'Class successfully deleted.');
    }
}



